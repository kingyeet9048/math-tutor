/**
 * 
 * @param {String} filePath 
 * @param {JSON} postData 
 * @param {function} resultFunction 
 */
function sendRequest (filePath, postData, resultFunction) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", filePath, true);
    xhr.setRequestHeader('Content-Type', 'application/xwww-form-urlencoded');
    xhr.send(postData);
    xhr.onreadystatechange = function() {
        resultFunction(this.readyState, this.status, this);
    }
}
/**
 * 
 * @param {String} apiPath 
 * @param {JSON} postBody 
 * @returns promise
 */
async function processRequest(apiPath, postBody) {
    return new Promise((resolve) => {
        sendRequest(apiPath, JSON.stringify(postBody), (readyState, statusCode, theRequest) => {
            if (readyState == 4 && statusCode == 200) {
                try {
                    const result = JSON.parse(theRequest.responseText);
                    if(result.error) {
                        resolve({'error': theRequest.responseText + ' api path - ' + apiPath});

                    }
                    else {
                        resolve(result);
                    }
                }
                catch (err) {
                    resolve({'error': theRequest.responseText + ' api path - ' + apiPath});
                }
            }
        });
    })
}

function sendBack() {
    window.location.replace("http://localhost/math-tutor/");
}