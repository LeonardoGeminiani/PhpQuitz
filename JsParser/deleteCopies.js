const fs = require("fs");
const {readFile} = require("fs");
const {stringify} = require('csv-stringify/sync');

readFile("domande.csv", "utf8", async (error, textContent) => {
    let newCSV = "";

    if(error){ throw error; }
    let i = 0;
    let arr = [];
    for(let row of textContent.split("\n")){
        if(i++ === 0) continue;
        arr.push(row.split(","));
    }

    let ind = 0;
    let cntArr = [];

    let outArr = [];
    for(let i of arr){
        let jnd = 0;
        for(let j of arr){
            if(i[0] == j[0] && ind != jnd){
                if(!cntArr.includes(ind) && !cntArr.includes(jnd)){
                    outArr.push(i);
                    // console.log(i[0]);
                    // console.log(i[0], ind);
                }
                cntArr.push(ind);
                cntArr.push(jnd);
            }
            jnd++;
        }
        ind++;
    }

    ind = 0;
    for(let i of arr){
        if(!cntArr.includes(ind)){
            // console.log(i[0], ind);
            outArr.push(i);
        }
        ind++;
    }
    console.log(outArr.length);


    const out = stringify(outArr);
    // console.log(out);
    fs.writeFileSync("domande1.csv", out);
    
});