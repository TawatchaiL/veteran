const fs = require('fs');
const path = require('path');

// ระบุโฟลเดอร์ที่ต้องการค้นหา
const folderPath = '/var/www/html/crm/public/download/';

// ค้นหาไฟล์ในโฟลเดอร์
fs.readdir(folderPath, (err, files) => {
    if (err) {
        console.error('Error reading folder:', err);
        return;
    }

    // ตรวจสอบว่ามีไฟล์หรือไม่
    if (files.length === 0) {
        console.log('No files found in the folder.');
        return;
    }

    // วนลูปผ่านไฟล์ที่พบ
    files.forEach((fileName) => {
        const filePath = path.join(folderPath, fileName);

        // ตรวจสอบว่าเป็นไฟล์หรือไม่
        fs.stat(filePath, (statErr, stats) => {
            if (statErr) {
                console.error('Error checking file stats:', statErr);
                return;
            }

            if (stats.isFile()) {
                // ทำงานกับไฟล์ที่พบ
                console.log('Found file:', fileName);

                // อ่านเนื้อหาของไฟล์
                fs.readFile(filePath, 'utf8', (readErr, data) => {
                    if (readErr) {
                        console.error('Error reading file:', readErr);
                        return;
                    }

                    // ทำงานกับข้อมูลที่ได้จากการอ่านไฟล์
                    console.log('File content:', data);
                });
            }
        });
    });
});
