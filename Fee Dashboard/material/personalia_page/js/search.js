function searchbox() {
    var input, filter, cardlist, label, i, txtValue, cardbody;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    cardlist = document.getElementById("content");
    console.log(cardlist)
    cardbody = cardlist.getElementsByClassName("card");
    for( let i = 0; i < cardbody.length; i++){
        let title = cardbody[i].querySelector(".card-body label.card-title");
        console.log(title)
        if(title.innerText.toUpperCase().indexOf(input) > -1){
            cardbody[i].style.display = "";
        }else{
            cardbody[i].style.display = "none";
        }
    }
    // for (i = 0; i < cardbody.length; i++) {
    //     label = cardbody[i].getElementsById("label")[0];
    //     txtValue = label.textContent || label.innerText;
    //     if (txtValue.toUpperCase().indexOf(filter) > -1) {
    //         cardbody[i].style.display = "";
    //     } else {
    //         cardbody[i].style.display = "none";
    //     }
    // }
    console.log(cardbody)
}