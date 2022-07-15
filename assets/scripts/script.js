let a = document.getElementById("a");
let b = document.getElementById("b");
let u0 = document.getElementById("u0");
let u1 = document.getElementById("u1");
let submitBtn = document.getElementById("submit");
let errorElt = document.getElementById("error");
let resultElt = document.getElementById("result");
let loadingImg = document.createElement("img");
loadingImg.src = "./assets/images/Filled_fading_balls.gif";

submitBtn.addEventListener("click", (e) => {

    resultElt.innerText = "";
    resultElt.appendChild(loadingImg);
    if (a.value === "" || b.value === ""
        || u0.value === "" || u1.value === "") {
        errorElt.innerText = "Please fill all cells";
    }
    else {
        errorElt.innerText = "";
        let formData = new FormData();
        formData.append("a", a.value);
        formData.append("b", b.value);
        formData.append("u0", u0.value);
        formData.append("u1", u1.value);
        fetch("../../back.php", {
            method: 'POST',
            // if posting body inside the $_POST variable
            body: formData
            // if posting body to php://input
            // body: {a: a.value, b:b.value, u0:u0.value, u1: u1.value}
        }).then((res) => res.json())
            .then((data) => {
                console.log(data);
                resultElt.removeChild(loadingImg);
                resultElt.innerText = "$" + data.value + "$";
                MathJax.typeset();
            })
            .catch((err) => {
                console.log("error : ", err);
            })
    }
});


// let handleInput = function (e) {
//     // Only numbers and -
//     if (e.inputType == "insertText") {
//         e.target.value = e.target.value.slice(0, -1);
//         if (/[0-9.-]/.test(e.data)) {
//             e.target.value = e.target.value.concat(e.data)
//         }
//     }
// }

// a.addEventListener('input', handleInput);
// b.addEventListener('input', handleInput);
// u0.addEventListener('input', handleInput);
// u1.addEventListener('input', handleInput);