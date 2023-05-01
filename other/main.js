// // Example POST method implementation:
// async function postData(url = "", data = {}) {
//     // Default options are marked with *
//     const response = await fetch(url, {
//         method: "POST", // *GET, POST, PUT, DELETE, etc.
//         mode: "cors", // no-cors, *cors, same-origin
//         cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
//         credentials: "same-origin", // include, *same-origin, omit
//         // headers: {
//         //     "Content-Type": "application/json",
//         //     // 'Content-Type': 'application/x-www-form-urlencoded',
//         // },
//         redirect: "follow", // manual, *follow, error
//         referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
//         body: JSON.stringify(data), // body data type must match "Content-Type" header
//     });
//     return response; // parses JSON response into native JavaScript objects
// }

// postData("json/index.php", { answer: 42 }).then((data) => {
//     console.log(data); // JSON data parsed by `data.json()` call
// });


fetch('http:127.0.0.1:80/json/posts')
    .then(response => response.json())
    .then(data => console.log);
console.log("HELLO")
console.log(`href  ${window.location.href}`)
console.log(`host  ${window.location.host}`)
console.log(`hostname  ${window.location.hostname}`)
console.log(`hash  ${window.location.hash}`)
console.log(`origin  ${window.location.origin}`)
console.log(`pathname  ${window.location.pathname}`)
// let rez = await fetch('http://json');
// let posts = await rez.json();
// console.log(posts);