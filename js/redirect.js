$(document).ready(function(){

    const data = window.localStorage.getItem('THEME');
    console.log("current theme: " + data);

    themeLoad()

    function themeLoad() {
        if (localStorage.getItem("THEME") == null) {
            const element = document.getElementById("THEME");
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                localStorage.setItem("THEME", "DARK");
            } else if (window.matchMedia('(prefers-color-scheme: light)').matches) {
                localStorage.setItem("THEME", "LIGHT");
            } else if (window.matchMedia('(prefers-color-scheme: no-preference)').matches) {
                localStorage.setItem("THEME", "SYSTEM");
            }
        }

        themeColor()
    }

    function themeColor() {
        const body = document.getElementById("THEME");
        switch (localStorage.getItem("THEME")) {
            case "SYSTEM":

                //add elements
                body.classList.add("theme_SYSTEM");

                //remove elements
                body.classList.remove("theme_DARK","theme_LIGHT")

                break;
            case "LIGHT":

                //add elements
                body.classList.add("theme_LIGHT");

                //remove elements
                body.classList.remove("theme_SYSTEM","theme_DARK")

                break;
            case "DARK":

                //add elements
                body.classList.add("theme_DARK");

                //remove elements
                body.classList.remove("theme_SYSTEM","theme_LIGHT")

                break;
        }
    }

    function themeSwitch(){
        switch (localStorage.getItem("THEME")) {
            case "SYSTEM":

                //set local storage
                localStorage.setItem("THEME", "LIGHT");

                return;
            case "LIGHT":

                //set local storage
                localStorage.setItem("THEME", "DARK");

                return;
            case "DARK":

                //set local storage
                localStorage.setItem("THEME", "SYSTEM");

                return;
        }
    }


    $(".switch_theme").click(function (){
        const preData = window.localStorage.getItem('THEME');

        themeSwitch()

        const postData = window.localStorage.getItem('THEME');

        // console.log(preData + " -> " + postData);

        themeColor()

        const loginButton =  document.getElementById("login_button");
        const body = document.getElementById("THEME");
        if (!body.classList.contains("duration-1000")) {
            body.classList.add("duration-1000")
            loginButton.classList.add("duration-1000")
        }

    });


});


// // ES6
// // Animal.js
// export class Animal {
//     constructor(name, legs) {
//         this.name = name;
//         this.legs = legs;
//     }
//
//     makeSound() {
//         console.log("Animal sound");
//     }
// }
//
// // Dog.js
// import { Animal } from "./Animal.js";
//
// export class Dog extends Animal {
//     constructor(name, legs, breed) {
//         super(name, legs);
//         this.breed = breed;
//     }
//
//     makeSound() {
//         console.log("Bark");
//     }
// }
//
// // Automatic Class Loader
// const classLoader = (path, classes = []) => {
//     return classes.map(cls => {
//         return require(path + cls);
//     });
// }
//
// const classes = classLoader('./', ['Animal', 'Dog']);
// const [Animal, Dog] = classes;
//
// let myDog = new Dog("Fido", 4, "Labrador Retriever");
// myDog.make


























































