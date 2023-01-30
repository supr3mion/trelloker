$(document).ready(function(){

    const buttons = document.querySelectorAll("#levelButton")
    const submitAnswer = document.getElementById("submitAnswer");

    const answerButton = document.getElementById("answerButton");
    const answerPermanent = document.getElementById("answerPermanent");

    const nextCard = document.getElementById("nextCard");

    const showAnswers = document.getElementById("showAnswers");
    const playerAnswers = document.getElementById("playerAnswers");

    const PLAYERID = document.getElementById("PLAYERID").innerHTML
    const POKERID = document.getElementById("POKERID").innerHTML

    const saveAndQuitObject = document.getElementById('saveAndQuitObject');
    const saveAndQuitButton = document.getElementById('saveAndQuitButton');

    const completePlayerObject = document.getElementById('completePlayerObject');

    const card = document.getElementById('card')

    let ANSWER = "";

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function() {

            console.log(this.value)

            ANSWER = this.value;

            answerButton.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
            answerButton.classList.add(buttons[i].classList[1]);
            answerButton.classList.remove('hidden')
            answerButton.innerHTML = this.value;

            buttons.forEach(function (element) {
                element.classList.add("hidden")
            })

            answerPermanent.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
            answerPermanent.classList.add(buttons[i].classList[1])
            answerPermanent.innerHTML = this.value;

            if(playerAnswers.classList.contains('hidden')) {
                submitAnswer.classList.remove('hidden')
            } else {
                nextCard.classList.remove('hidden')
            }

        });
    }

    answerButton.addEventListener("click", function () {

        answerPermanent.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
        answerPermanent.classList.add('hidden')

        answerButton.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
        answerButton.classList.add('hidden')

        submitAnswer.classList.add('hidden')

        nextCard.classList.add('hidden')

        buttons.forEach(function (element) {
            element.classList.remove("hidden")
        })
    })

    $("#submitAnswer").click(function (){

        answerButton.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
        answerButton.classList.add('hidden')

        submitAnswer.classList.add('hidden')

        answerPermanent.classList.remove('hidden')
        showAnswers.classList.remove('hidden')

        buttons.forEach(function (element) {
            element.classList.add("hidden")
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
                // console.log(response);
            }
        });

        ANSWER = "";

    })

    $("#showAnswers").click(function () {

        answerPermanent.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
        answerPermanent.classList.add('hidden')

        showAnswers.classList.add("hidden")

        buttons.forEach(function (element) {
            element.classList.remove("hidden")
        })

        playerAnswers.classList.remove('hidden')

        $.ajax({
            type: 'GET',
            url: '../php/updateAJAX.php',
            data: {
                showAnswers: 'showAnswers',
                POKERID: POKERID
            },
            success: function(response) {
                const data = JSON.parse(response);

                let HTML = '';
                if (data.status === "success") {
                    console.log(data.answers);

                    if (data.answers.length > 0) {
                        for (let i = 0; i < data.answers.length; i++) {
                            HTML = '<p class="rounded bg-' + data.answers[i][4] + ' p-4">' + data.answers[i][4] + '</p>'
                            playerAnswers.innerHTML += HTML;
                        }
                    } else {
                        HTML = '<p class="col-span-5 p-4 text-3xl">Er zijn geen antwoorden verzonden</p>'
                        playerAnswers.innerHTML += HTML;
                    }


                } else {
                    console.log("Error: " + data.message);
                }
            }
        });

    })

    saveAndQuitObject.addEventListener("click", function () {

        $.ajax({
            type: 'GET',
            url: '../php/updateAJAX.php',
            data: {
                saveAndQuitObject: 'saveAndQuitObject',
                POKERID: POKERID
            },
            success: function(response) {
                console.log(response);
            }
        });
    })

    nextCard.addEventListener("click", function () {

        answerButton.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
        answerButton.classList.add('hidden')

        submitAnswer.classList.add('hidden')

        answerPermanent.classList.add('hidden')
        showAnswers.classList.add('hidden')

        buttons.forEach(function (element) {
            element.classList.remove("hidden")
        })

        playerAnswers.innerHTML = "";

        $.ajax({
            type: 'GET',
            url: '../php/updateAJAX.php',
            data: {
                saveAndContinue: 'saveAndContinue',
                level : ANSWER,
                cardID: document.getElementById('cardID').innerHTML,
                BOARD_ID: document.getElementById('BOARD_ID').innerHTML
            },
            success: function(response) {
                // console.log(response)
                const data = JSON.parse(response);
                if (data.status === "success") {
                    // console.log(data.done);
                    if (data.done === 'true') {

                        completePlayerObject.classList.add('hidden')

                        saveAndQuitObject.classList.remove('hidden')
                    } else {
                        nextCard.classList.add('hidden')
                        playerAnswers.classList.add('hidden')

                        card.innerHTML = '';

                        $.ajax({
                            type: 'GET',
                            url: '../php/updateAJAX.php',
                            data: {
                                NextCard: 'NextCard',
                                POKERID: POKERID
                            },
                            success: function(response) {
                                // console.log(response)
                                // const data = JSON.parse(response);
                                let HTML;
                                // console.log(data)
                                // console.log("card ID: " + data.cardID)
                                HTML = '<div id="cardID" class="hidden">' + data.cardID + '</div>'
                                if (data.status === "success") {
                                    if (data.card !== "no card" && data["description"] !== '') {
                                        HTML = HTML +  '<p class="text-3xl">' + data.card + '</p>\n'

                                    } else if (data.card !== "no card") {
                                        HTML = HTML + '<p class="text-3xl">' + data.card + '</p>\n' +
                                            // '<p class="text-base"> + data["description"] + </p>\n' +
                                            '<p class="text-base">' + data["description"] + '</p>\n'

                                    } else if (data.card === "no card") {
                                        // HTML = '<p id="noCard" class="text-3xl">Momenteel geen actieve kaart</p>'
                                        completePlayerObject.classList.add('hidden')

                                        saveAndQuitObject.classList.remove('hidden')

                                        return
                                    }

                                } else {
                                    HTML = '<p class="text-3xl">Er was een error tijdens het starten</p>\n' +
                                        '<p class="text-xl">Indien deze error vaker tegenkomt, meld dit dan bij de admin</p>'
                                }
                                card.innerHTML = HTML
                            }
                        });

                    }
                }
            }
        });
    })
})




