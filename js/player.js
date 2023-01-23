$(document).ready(function(){

        // const buttons = document.querySelectorAll("#levelButton");
        // for (let i = 0; i < buttons.length; i++) {
        //         buttons[i].addEventListener("click", function() {
        //                 // const output = document.getElementById("output");
        //                 // output.innerHTML = "You clicked button: " + this.value;
        //                 console.log(this.value)
        //         });
        // }

        const card = document.getElementById("card")

        let currentCard = card.innerHTML;

        // setInterval(function () {
        //         const xhttp = new XMLHttpRequest();
        //         xhttp.onreadystatechange = function () {
        //                 if (this.readyState === 4 && this.status === 200) {
        //                         const newCard = this.responseText;
        //
        //                         if (newCard !== currentCard) {
        //                                 card.innerHTML = newCard;
        //                                 currentCard = newCard;
        //                         }
        //                 }
        //         };
        //         xhttp.open("GET", "../php/classes/playerLoader.class.php", true)
        //         xhttp.send();
        //
        // }, 1000);

        // function refreshCard() {
        //
        //         $('#card').load(' #card');
        //         setTimeout(refreshCard, 1000)
        // }
})