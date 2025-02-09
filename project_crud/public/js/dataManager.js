let patreonsData =  []
const records = localStorage.getItem("records")

if (records) {
  
  patreonsData = JSON.parse(records)
  
 
}


export const addData = (data) => {
  console.log(patreonsData)
  patreonsData.push(data)
  
  let patreonsDataString = JSON.stringify(patreonsData) // stringify
localStorage.setItem("records", patreonsDataString)
}





export const getData = () =>{ 
  let patreonsRecord = localStorage.getItem("records") // parse from local storage

  let patreonsDataJSON = JSON.parse(patreonsRecord)
  
  return patreonsDataJSON
}

export const deleteData = (filteredArray) =>{
   let patreonsData = filteredArray
  let patreonsDataString = JSON.stringify(patreonsData) // stringify
localStorage.setItem("records", patreonsDataString)


  
}


export const updateData = (originalId , updatedID, updatedName , updatedTitleOfBook ,updatedDate) => {
  patreonsData.forEach(object =>  {
  if(object.id == originalId) {
    object.id = updatedID
    object.name = updatedName
    object.titleOfBook = updatedTitleOfBook
    object.borrowedDate = updatedDate
  }
  }
  )
  let patreonsDataString = JSON.stringify(patreonsData) // stringify
localStorage.setItem("records", patreonsDataString)
  console.log(patreonsData)
}