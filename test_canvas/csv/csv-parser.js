const csvtojson = require('csvtojson')
const fs = require('fs')

fs.createReadStream('data.csv')
  .pipe(csv())
  .on('data', (row) => {
    console.log(row.number)
  })
  .on('end', () => {
    console.log('CSV file successfully processed');
  });


module.exports.convertcsvtojson = convertcsvtojson;