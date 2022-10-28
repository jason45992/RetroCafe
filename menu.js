function updateContentByFilter(id) {
    if(id == "all"){
        document.getElementById("all").classList = ["active"];
        document.getElementById("coffee").classList = ["inActive"];
        document.getElementById("cake").classList = ["inActive"];

    }else if(id == "coffee"){
        document.getElementById("all").classList = ["inActive"];
        document.getElementById("coffee").classList = ["active"];
        document.getElementById("cake").classList = ["inActive"];

    }else if(id == "cake"){
        document.getElementById("all").classList = ["inActive"];
        document.getElementById("coffee").classList = ["inActive"];
        document.getElementById("cake").classList = ["active"];
        
    }
}