function updateContentByFilter(id) {
    if(id == "btn-all"){
        document.getElementById("btn-all").classList = ["active"];
        document.getElementById("btn-coffee").classList = ["inActive"];
        document.getElementById("btn-cake").classList = ["inActive"];

    }else if(id == "btn-coffee"){
        document.getElementById("btn-all").classList = ["inActive"];
        document.getElementById("btn-coffee").classList = ["active"];
        document.getElementById("btn-cake").classList = ["inActive"];

    }else if(id == "btn-cake"){
        document.getElementById("btn-all").classList = ["inActive"];
        document.getElementById("btn-coffee").classList = ["inActive"];
        document.getElementById("btn-cake").classList = ["active"];
        
    }
}