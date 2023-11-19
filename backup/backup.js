const fs = require('fs');
const path = require('path');
const archiver = require('archiver');
const mysql = require('mysql2/promise');

// Database configuration
const dbConfig = {
    host: 'localhost',
    user: 'root',
    password: 'rsiippbx@2022',
    database: 'crm',
};

//db
const pool = mysql.createPool(dbConfig);

// Specify the folder path
const folderPath = '/var/www/html/crm/public/download';
const wavPath = '/var/www/html/crm/public/wav';

// Generate the current date and time for the output zip file name
const currentDateTime = new Date().toISOString().replace(/[-T:.Z]/g, '').replace(/(\d{8})(\d{6})/, '$1_$2');
const outputZipPath = `/var/www/html/crm/public/zip/output_${currentDateTime}.zip`;

let totalLines = 0;
let linesProcessed = 0;

// Function to calculate progress percentage
let calculateProgress = (linesProcessed) => {
    return ((linesProcessed / totalLines) * 100) * (90 / 100);
};

// Mock function to update progress in the database
let updateProgress = async (recid, progress) => {
    console.log(`Updating progress for ${recid} to ${progress}% in the database.`);
    const connection = await pool.getConnection();
    try {
        const query = 'UPDATE voice_backups SET export_progress = ? WHERE id = ?';
        await connection.query(query, [progress, recid]);
    } catch (error) {
        console.error('Error updating progress in the database:', error);
    } finally {
        connection.release();
    }
};

let updateStatus = async (recid, status) => {
    console.log(`Updating progress for ${recid} to ${status} in the database.`);
    const connection = await pool.getConnection();
    try {
        const query = 'UPDATE voice_backups SET export_status = ? WHERE id = ?';
        await connection.query(query, [status, recid]);
    } catch (error) {
        console.error('Error updating progress in the database:', error);
    } finally {
        connection.release();
    }
};

let updateFileName = async (recid, filename) => {
    console.log(`Updating progress for ${recid} to ${filename} in the database.`);
    const connection = await pool.getConnection();
    try {
        const query = 'UPDATE voice_backups SET export_filename = ? WHERE id = ?';
        await connection.query(query, [filename, recid]);
    } catch (error) {
        console.error('Error updating progress in the database:', error);
    } finally {
        connection.release();
    }
};


fs.readdir(folderPath, async (err, files) => {
    if (err) {
        console.error('Error reading folder:', err);
        return;
    }

    // Filter out non-txt files
    const txtFiles = files.filter((fileName) => fileName.endsWith('.txt'));
    const recids = txtFiles.map((fileName) => fileName.slice(0, -4));

    // Check if there are any txt files
    if (txtFiles.length === 0) {
        console.log('No txt files found in the folder.');
        return;
    }

    await updateStatus(recids[0], 2);
    await updateFileName(recids[0], `output_${currentDateTime}.zip`);

    // Create a write stream for the zip file
    const output = fs.createWriteStream(outputZipPath);
    const archive = archiver('zip', {
        zlib: { level: 9 } // Sets the compression level
    });

    // Pipe the archive stream to the output file
    archive.pipe(output);

    // Use Promise to make the process more synchronous
    const readPromises = txtFiles.map((fileName) => {
        return new Promise(async (resolve, reject) => {
            const filePath = path.join(folderPath, fileName);

            // Read the content of the file
            fs.readFile(filePath, 'utf8', async (readErr, data) => {
                if (readErr) {
                    console.error('Error reading file:', readErr);
                    reject(readErr);
                    return;
                }

                // Split the content by lines
                const lines = data.split('\n');

                // Increment totalLines for each line
                totalLines += lines.length;

                // Process each line or use it as needed
                for (const line of lines) {
                    // Split each line by comma and create an array
                    const lineArray = line.split(',');

                    // Add the file to the zip archive with the new name
                    const originalFilePath = path.join(wavPath, lineArray[0]);
                    const newFileName = lineArray[1];

                    if (fs.existsSync(originalFilePath)) {
                        // Use path.join to ensure correct file paths in the archive
                        archive.append(fs.createReadStream(originalFilePath), {
                            name: path.join('zip', newFileName),
                        });

                        // Update progress in the database
                        const progress = calculateProgress(++linesProcessed);
                        await updateProgress(recids[0], progress);
                    } else {
                        console.warn(`File not found: ${originalFilePath}`);
                        // Optionally handle the case when the file is not found
                        // For example, you can log a warning or proceed without adding the file
                    }
                }

                archive.append(fs.createReadStream(path.join(folderPath, recids[0] + '.csv')), {
                    name: path.join('zip', recids[0] + '.csv'),
                });
                await updateProgress(recids[0], 92);

                fs.unlink(path.join(folderPath, recids[0] + '.csv'), (unlinkErr) => {
                    if (unlinkErr) {
                        console.error('Error deleting file:', unlinkErr);
                    } else {
                        console.log('File deleted:', fileName);
                    }
                });
                // Delete the text file
                fs.unlink(filePath, (unlinkErr) => {
                    if (unlinkErr) {
                        console.error('Error deleting file:', unlinkErr);
                    } else {
                        console.log('File deleted:', fileName);
                    }
                    resolve();
                });
            });
        });
    });

    // Wait for all file read promises to resolve before finalizing the archive
    try {
        await Promise.all(readPromises);
    } catch (error) {
        console.error('Error processing files:', error);
        // Optionally handle errors during the process
    } finally {
        // Finalize the archive when all files are added
        archive.finalize();
    }

    // Handle archive events
    output.on('close', async () => {
        await updateProgress(recids[0], 100);
        console.log(`${archive.pointer()} total bytes`);
        console.log('Archiver has been finalized and the output file descriptor has closed.');
        await updateStatus(recids[0], 3);
        process.exit();
    });

    archive.on('warning', (warn) => {
        console.warn(warn);
    });

    archive.on('error', (err) => {
        console.error(err);
    });
});


