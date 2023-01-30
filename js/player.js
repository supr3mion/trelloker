$(document).ready(function () {
        const buttons = document.querySelectorAll("#levelButton")
        const submitAnswer = document.getElementById("submitAnswer");
        const Card = document.getElementById("card");

        const answerButton = document.getElementById("answerButton");
        const answerPermanent = document.getElementById("answerPermanent");

        const PLAYERID = document.getElementById("PLAYERID").innerHTML

        let prevCard = Card.innerHTML;

        let ANSWER = "";

        // ---------------------------------------------------------------------------------[buttons]

        if (Card.innerHTML.includes("noCard")) {
                buttons.forEach(function (element) {
                        element.classList.add("hidden")
                })

                $.ajax({
                        type: 'GET',
                        url: '../php/updateAJAX.php',
                        data: {
                                checkPlayerID: 'checkPlayerID',
                                PLAYERID: PLAYERID
                        },
                        success: function(response) {
                                console.log(response);
                                const data = JSON.parse(response);
                                if (data["player"] === "false") {
                                        window.location.href = "..";
                                }
                        }
                });

        }

        for (let i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener("click", function() {

                        ANSWER = this.value;

                        buttons.forEach(function (element) {
                                element.classList.add("hidden")
                        })

                        answerButton.classList.add(buttons[i].classList[1]);
                        answerButton.classList.remove('hidden')
                        answerButton.innerHTML = this.value;

                        answerPermanent.classList.add(buttons[i].classList[1])
                        answerPermanent.innerHTML = this.value;

                        submitAnswer.classList.remove('hidden')

                });
        }

        answerButton.addEventListener("click", function () {

                answerButton.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
                answerButton.classList.add('hidden')

                answerPermanent.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
                answerPermanent.classList.add('hidden')

                submitAnswer.classList.add('hidden')

                buttons.forEach(function (element) {
                        element.classList.remove("hidden")
                })
        })

        // ---------------------------------------------------------------------------------[functions]

        function refreshCard() {
                $('#card').load(' #card > *', function(){
                        console.log(prevCard === Card.innerHTML)

                        if(prevCard !== Card.innerHTML && !Card.innerHTML.includes("noCard")) {

                                prevCard = Card.innerHTML

                                answerPermanent.classList.add('hidden')
                                answerPermanent.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')

                                buttons.forEach(function (element) {
                                        element.classList.remove("hidden")
                                })

                                clearTimeout(timeoutID)

                        } else if (Card.innerHTML.includes("noCard")) {
                                answerPermanent.classList.add('hidden')
                                answerPermanent.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
                        }
                })
                let timeoutID = setTimeout(refreshCard, 5000)
        }

        refreshCard()

        // ---------------------------------------------------------------------------------[actions]

        $("#submitAnswer").click(function (){
                prevCard = Card.innerHTML;

                answerButton.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
                answerButton.classList.add('hidden')

                submitAnswer.classList.add('hidden')

                answerPermanent.classList.remove('hidden')

                buttons.forEach(function (element) {
                        element.classList.add('hide')
                })

                $.ajax({
                        type: 'GET',
                        url: '../php/updateAJAX.php',
                        data: {
                                submitAnswer: 'submitAnswer',
                                level : ANSWER,
                                PLAYERID: PLAYERID
                        },
                        success: function(response) {
                                console.log(response);
                        }
                });

                ANSWER = "";
                refreshCard()

        })
})