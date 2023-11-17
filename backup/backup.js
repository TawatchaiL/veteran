const fs = require('fs');
const mysql = require('mysql2/promise');
const archiver = require('archiver');

const dbConfig = {
    host: 'localhost',
    user: 'root',
    password: 'rsiippbx@2022',
    database: 'crm',
};

const pbx_dbConfig = {
    host: '10.10.0.99',
    user: 'root',
    password: 'rsiippbx@2022',
    database: 'call_center',
};

async function createBackup(record, startDate) {
    try {
        const zipFileName = `backup_${startDate.toISOString().split('T')[0]}.zip`;
        const zipStream = fs.createWriteStream(zipFileName);
        const archive = archiver('zip');

        archive.pipe(zipStream);

        const filePath = `/var/www/html/crm/public/wav/${record.recordingfile}`;

        // Check if the file exists before attempting to append it to the archive
        if (fs.existsSync(filePath)) {
            archive.append(fs.createReadStream(filePath), { name: record.recordingfile });
        } else {
            console.warn(`File not found: ${filePath}`);
            // Optionally handle the case when the file is not found
            // For example, you can log a warning or proceed without adding the file
        }

        // Use the promise-based finalize to ensure the archive is fully finalized before proceeding
        await new Promise((resolve, reject) => {
            archive.finalize();
            zipStream.on('close', resolve);
            archive.on('error', reject);
        });

        // Update export_status and export_progress in the database
        // Implement your logic to update the export_status and export_progress columns in the database
    } catch (error) {
        console.error('Error in createBackup:', error.message);
    }
}

async function listCdrFiles(startDate, endDate) {
    const connection = await mysql.createConnection(pbx_dbConfig);

    try {
        const [rows] = await connection.execute(`
            SELECT uniqueid, calldate, recordingfile
            FROM asteriskcdrdb.cdr
            WHERE calldate BETWEEN ? AND ?
            AND dstchannel != ''
            AND recordingfile != ''
            AND disposition = 'ANSWERED'
            ORDER BY calldate DESC
        `, [startDate, endDate]);

        const agentArray = {
            1: { name: 'Agent1' },
            2: { name: 'Agent2' },
            // Add other agents as needed
        };

        for (const row of rows) {
            let id = row.uniqueid;
            //let calldate = row.calldate;

            const remoteData = await getRemoteData(id);
            const cdrData = remoteData || row;

            let voic_name = '';

            let voic;
            if (remoteData) {

                voic = remoteData.recordingfile;
                const avoic_name = voic.split('/');
                voic_name = /* agentArray[cdrData.crm_id].name +  '-'*/ + avoic_name[avoic_name.length - 1];
                console.log(voic_name)
            } else {
                console.log(row)
                const avoic = row.recordingfile.split('/');
                /* const datep = row.calldate.split(' ')[0].split('-');
                voic = datep[0] + '/' + datep[1] + '/' + datep[2] + '/' + avoic[avoic.length - 1];

                let agentname = '';

                if (cdrData.dst_userfield !== null) {
                    agentname = agentArray[cdrData.dst_userfield].name;
                } else if (cdrData.accountcode !== '' && cdrData.userfield !== '') {
                    agentname = agentArray[cdrData.userfield].name;
                }

                agentname = agentname || 'NoAgent';

                voic_name = agentname + '-' + avoic[avoic.length - 1]; */
            }



            const originalFilePath = '/var/www/html/crm/public/wav/' + voic_name;

            if (!fs.existsSync(originalFilePath)) {
                console.warn(`Skipped file: ${originalFilePath}`);
                continue; // Skip to the next iteration if the file is not found
            }

            const fileContent = fs.readFileSync(originalFilePath);

            if (!fileContent) {
                console.error('Failed to retrieve file content');
                continue; // Skip to the next iteration if the file content cannot be retrieved
            }

            // Process the file content as needed (e.g., create a backup)
            await createBackup(cdrData, new Date(calldate));
        }

        // return rows; // Note: You might want to return something here based on your requirements
    } finally {
        await connection.end();
    }
}


async function getRemoteData(uniqueid) {
    const connection = await mysql.createConnection(pbx_dbConfig);

    try {
        const [rows] = await connection.execute('SELECT * FROM call_center.call_recording WHERE uniqueid = ?', [uniqueid]);
        return rows[0];
    } finally {
        await connection.end();
    }
}

async function getRecordsFromDatabase() {
    const connection = await mysql.createConnection(dbConfig);

    try {
        const [rows] = await connection.execute('SELECT * FROM voice_backups WHERE export_status = ?', [1]);
        return rows;
    } finally {
        await connection.end();
    }
}

async function main() {
    try {
        const recordsFromDatabase = await getRecordsFromDatabase();

        if (recordsFromDatabase.length === 0) {
            console.log('No records found for export_status = 1');
            return;
        }

        const startDate = new Date(recordsFromDatabase[0].export_start);
        const endDate = new Date(recordsFromDatabase[0].export_end);

        await listCdrFiles(startDate, endDate);

        console.log('Backup process completed.');
    } catch (error) {
        console.error('Error:', error.message);
    }
}

// Run the main function
main();
