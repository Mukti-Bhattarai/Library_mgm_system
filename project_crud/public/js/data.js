import { getData , deleteData , updateData} from "./dataManager.js"

const displayGrid = document.querySelector ("#records-container")
const searchBar = document.querySelector ("#search-bar")

let patreonsData = getData()


document.addEventListener("DOMContentLoaded", displayRecords )
function displayRecords() {
  
  if (patreonsData===null) {
  
    return
  }

  // not displaying anything if there is no data




  // for ui
  
  patreonsData.forEach(data=> {
    
   const idEl =  document.createElement("p")
   const nameEl =  document.createElement("p")
   const titleOfBookEl =  document.createElement("p")
   const dateEl =  document.createElement("p")
   const editEl =  document.createElement("i")
   const deleteEl =  document.createElement("i")
   
   addAttributes()
   addContents()
   appendElements()
   
   deleteEl.addEventListener('click', e=> {
     e.preventDefault()
     deltePatreonData(e)
   } ) // for deleting individual record
   
   editEl.addEventListener('click',e=> {
     e.preventDefault()
     editPatreonData(e)
     
   })
   
   
   function addAttributes() {
     
     // Tab to edit
   idEl.classList.add("bg-white","w-full", "p-2",  "block", "h-full",data.id)
   
   nameEl.classList.add("bg-white","w-full", "p-2",  "block", "h-full",data.id)
   titleOfBookEl.classList.add("bg-white","w-full", "p-2",  "block", "h-full",data.id)
   dateEl.classList.add("bg-white","w-full", "p-2",  "block", "h-full",data.id)
   editEl.classList.add("bg-cyan-400","w-full", "p-2", "block", "h-full","fa-solid", "fa-pen-to-square","text-center","text-2xl",data.id)
   deleteEl.classList.add("bg-red-400", "w-full", "p-2", "block", "h-full", "fa-solid", "fa-trash","text-center","text-2xl",data.id)
   editEl.id = data.id
   deleteEl.id = data.id
   
   
   }
   
   function addContents() {
     
     // Tab to edit
     idEl.textContent = data.id
     nameEl.textContent = data.name
     titleOfBookEl.textContent = data.titleOfBook
     dateEl.textContent = data.borrowedDate
   }
   
   
   
   function appendElements() {
     // Tab to edit
   displayGrid.append(idEl)
   displayGrid.append(nameEl)
   displayGrid.append(titleOfBookEl)
   displayGrid.append(dateEl)
   displayGrid.append(editEl)
   displayGrid.append(deleteEl)
   }
   
   function deltePatreonData(e){ // for delete
   
   const targetObjectID = e.target.id
   patreonsData = getData() // getting the latest data from local storage
   const filteredArray = patreonsData.filter(object => object.id != targetObjectID)
   
   deleteData(filteredArray)
   
   displayGrid.removeChild(idEl)
   displayGrid.removeChild(nameEl)
   displayGrid.removeChild(dateEl)
   displayGrid.removeChild(titleOfBookEl)
   displayGrid.removeChild(editEl)
   displayGrid.removeChild(deleteEl)
   
  
}

function editPatreonData({target}) {
  patreonsData = getData()
  
  const targetObjectID = target.id // original id
  if(target.classList.contains("fa-pen-to-square")){ // handling when clicked edit
    target.classList.remove("fa-pen-to-square")
    target.classList.add("fa-floppy-disk")
    idEl.contentEditable = true
    nameEl.contentEditable = true
    titleOfBookEl.contentEditable = true
    dateEl.contentEditable = true
    
    
    
}else{
  // handling when user saves changes
target.classList.remove("fa-floppy-disk")
target.classList.add("fa-pen-to-square")
    idEl.contentEditable = false
    nameEl.contentEditable = false
    titleOfBookEl.contentEditable = false
    dateEl.contentEditable = false
    updateDataArray()
    function updateDataArray() {
      // Tab to edit
      const updatedID = idEl.innerText
      const updatedName = nameEl.innerText
      const updatedTitleOfBook = titleOfBookEl.innerText
      const updatedDate = dateEl.innerText
      
      updateData(targetObjectID,updatedID,updatedName,updatedTitleOfBook,updatedDate)
      
      
    }
    
    
}

}
   
  })
  
  
}

searchBar.addEventListener("input", e=> {
  
  patreonsData = getData()
  if (e.target.value == "") {
    clearDisplayGrid()
    displayRecords()
    
  }
  
  let currentSearchValue = e.target.value
  patreonsData = patreonsData.filter(data=> data.name.includes(currentSearchValue))
  
  
  clearDisplayGrid()
  displayRecords()
  
  function clearDisplayGrid () {
    let recordElementsParagraphs = displayGrid.querySelectorAll("p")
    let recordElementsIcons = displayGrid.querySelectorAll("i")
    let recordElements = [...recordElementsParagraphs, ...recordElementsIcons]
    recordElements.forEach(element => {
    displayGrid.removeChild(element)
})
    
  }
  
})




