$(document).ready(function(){

    function switchInnerHTML() {
        switch (localStorage.theme) {
            case 'dark':
                if (document.getElementById('switch_theme')) {
                    document.getElementById('switch_theme').innerHTML = "Donker";
                }
                return;

            case 'light':
                if (document.getElementById('switch_theme')) {
                    document.getElementById('switch_theme').innerHTML = "Licht";
                }
                return;

            case undefined:
                if (document.getElementById('switch_theme')) {
                    document.getElementById('switch_theme').innerHTML = "Systeem";
                }
                return;
        }
    }

    function themeSwitch(){
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    }

    // console.log('hello')

    themeSwitch()
    switchInnerHTML()

    $("#switch_theme").click(function (){
        switch (localStorage.theme) {
            case 'dark':
                localStorage.theme = 'light'
                switchInnerHTML()
                themeSwitch()
                return;

            case 'light':
                localStorage.removeItem('theme')
                switchInnerHTML()
                themeSwitch()
                return;

            case undefined:
                localStorage.theme = 'dark'
                switchInnerHTML()
                themeSwitch()
                return;

        }
    })
})