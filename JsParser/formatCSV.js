const fs = require("fs");
const {readFile} = require("fs");


const sleep = (delay) => new Promise((resolve) => setTimeout(resolve, delay))

readFile("domande.csv", "utf8", async (error, textContent) => {
    let newCSV = "";

    if(error){ throw error; }
    let i = 0;
    for(let row of textContent.split("\n")){
        console.clear();
        if(i++ === 0) continue;
        const rowItems = row.split(";");

        let query = encodeURI(rowItems[0]);
        console.log(i);

        fetch(`https://kgsearch.googleapis.com/v1/entities:search?query=${query}&key=AIzaSyAz65f_5fNhV7wFpguCMBlD5m5BCTtteVg&limit=1&indent=True`)
            .then(res => res.json())
            .then(data => {
                if(!data.itemListElement[0]) {
                    console.error("UNDE");
                    return;
                }
                let res = data.itemListElement[0].result;
                if(!res || !(res.image) || !(res.image.contentUrl)) {
                    console.error("UNDEF");
                    return;
                }

                newCSV += row + ";" + res.image.contentUrl + "\n";
            });

        await sleep(500); // to reduce the risk of api not responding
    }
    
    fs.writeFile('domandeImg.csv', newCSV, err => {
        if (err) console.error(err);
    });
});
