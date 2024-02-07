const fs = require("fs");
const {readFile} = require("fs");
const {stringify} = require('csv-stringify/sync');

readFile("desc.csv", "utf8", async (error, textContent) => {
    if(error){ throw error; }
    // let i = 0;
    let arr = [];
    for(let row of textContent.split("\n")){
        // if(i++ === 0) continue;
        arr.push(row.split(","));
    }

    let newArr = [];
    for(let row of arr){
        let i = 0;
        let tmpArr = [];
        for(let el of row){
            if(i++ === 0) continue;
            tmpArr.push(el);
        }
        newArr.push(tmpArr.join(","));
    }

    // console.log(newArr);

    readFile("domandeImg.csv", "utf8", async (error, textContent) => {
        if(error){ throw error; }
        let i = 0;
        let arr = [];
        for(let row of textContent.split("\n")){
            if(i++ === 0) continue;
            arr.push(row.split(";"));
        }
        
        i = 0;
        for(let row of arr){
            row.push(newArr[i]);
            i++;
        }

        const out = stringify(arr, {
            delimiter: ";"
        });

        fs.writeFileSync("domandeImg1.csv", out);
    });
});