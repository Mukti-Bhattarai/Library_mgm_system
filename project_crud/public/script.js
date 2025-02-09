import { addData } from "./dataManager.js"

const myForm = document.querySelector ("form")


function initScript() {
  // Tab to edit

myForm.addEventListener("submit",e=> {
  e.preventDefault()
  const patreonID = myForm.querySelector("#SN").value
  const patreonName = myForm.querySelector("#NOS").value
  const titleOfBook = myForm.querySelector("#TOB").value
  const borrowedDate = myForm.querySelector("#DOB").value
  
  const patreonData = {
    id: patreonID,
    name: patreonName,
    titleOfBook,
    borrowedDate
  }
  
  addData(patreonData)
  
  
  
  
  myForm.querySelector("#SN").value = ""
  myForm.querySelector("#NOS").value = ""
  myForm.querySelector("#TOB").value = ""
  
  alert("Record Added Sucessfully")
})
}

// Conditionally execute code
if ( window.location.pathname.includes("Add_Data.html")) {
  
  initScript()
}

