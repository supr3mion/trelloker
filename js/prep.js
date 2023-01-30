document.addEventListener("DOMContentLoaded", function() {
    const addBtn = document.getElementById("addBtn");
    const emailList = document.getElementById("emailList");
    const emailInput = document.getElementById("email");
    const error = document.getElementById("error");
    const submitBtn = document.getElementById("submitBtn");
    const form = document.getElementById("myForm");
    submitBtn.disabled = true;
    submitBtn.innerHTML = "Add an email";
    submitBtn.classList.remove("bg-[#22c55e]", "hover:cursor-pointer");
    submitBtn.classList.add("bg-[#71717a]", "hover:cursor-not-allowed");
    addBtn.addEventListener("click", addEmail);
    submitBtn.addEventListener("click", loading);

    function addEmail() {
        // Check if email input is filled
        if (emailInput.value.trim() === "") {
            error.innerHTML = "Email is required";
            error.classList.add("bg-[#ef4444]", "w-full", "text-center", "rounded", "mt-3", "p-2", "border-2", "border-[#ef4444]");
            return;
        }

        // Check if email input is valid
        if (!emailInput.checkValidity()) {
            error.innerHTML = "Invalid email address";
            error.classList.add("bg-[#ef4444]", "w-full", "text-center", "rounded", "mt-3", "p-2", "border-2", "border-[#ef4444]");
            return;
        }

        // Get the email input value
        const email = emailInput.value;

        const emailExist = emailList.querySelectorAll('li');
        for(let i = 0; i < emailExist.length; i++) {
            if(emailExist[i].textContent.replace("Remove", "") === email) {
                error.innerHTML = "Email already exist";
                error.classList.add("bg-[#ef4444]", "w-full", "text-center", "rounded", "mt-3", "p-2", "border-2", "border-[#ef4444]");
                emailInput.value = "";
                return;
            }
        }

        error.innerHTML = "";
        error.classList.remove("bg-[#ef4444]", "w-full", "text-center",  "rounded", "mt-3", "p-2", "border-2", "border-[#ef4444]");

        // Create a new list item
        const newItem = document.createElement("li");
        newItem.innerHTML = email;
        newItem.classList.add("text-black","dark:text-white");

        // Create a new hidden input element
        const newInput = document.createElement("input");
        newInput.setAttribute("type","hidden");
        newInput.setAttribute("name","emails[]");
        newInput.setAttribute("value",email);

        // Append the new input element to the form
        form.appendChild(newInput);

        // Create a remove button
        const removeBtn = document.createElement("button");
        removeBtn.innerHTML = "Remove";
        removeBtn.classList.add("bg-[#ef4444]","text-black","dark:text-white","m-2","rounded","p-2");
        removeBtn.addEventListener("click", function() {
            emailList.removeChild(newItem);
            if (emailList.children.length === 0) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = "Add an email";
                submitBtn.classList.remove("bg-[#22c55e]", "hover:cursor-pointer");
                submitBtn.classList.add("bg-[#71717a]", "hover:cursor-not-allowed");
            }
        });

        // Append remove button to the list item
        newItem.appendChild(removeBtn);

        // Add the new list item to the list
        emailList.appendChild(newItem);

        //check if there are any emails added
        if(emailList.children.length > 0) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = "Start Trelloker"
            submitBtn.classList.add("bg-[#22c55e]", "hover:cursor-pointer");
            submitBtn.classList.remove("bg-[#71717a]", "hover:cursor-not-allowed");
        }

        // Clear the input
        emailInput.value = "";
    }

    function loading() {
        submitBtn.innerHTML = "<i class=\"fa-solid fa-spinner text-3xl animate-spin\"></i>";
    }
});
