const fs = require("fs");
const {readFile} = require("fs");
const {stringify} = require('csv-stringify/sync');

readFile("domandeImg.csv", "utf8", async (error, textContent) => {
    if(error){ throw error; }
    let i = 0;
    let arr = [];
    for(let row of textContent.split("\n")){
        if(i++ === 0) continue;
        arr.push(row.split(";"));
    }

    for(let row of arr){
        console.log(row[0]);
    }
});