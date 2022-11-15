window.onload = function(){
    
    function SearchCountry(country){
        return fetch(`http://localhost/info2180-lab5/world.php?country=${country}`)
        .then(response => {
            if(response.ok){
                return response.text()
            }
            else{
                throw new Error(`Error! status: ${response.status}`)
                }
            })
            .then((data) => data)
            .catch((err) => err);
    }

    document.getElementById("lookup").onclick = e => {
        e.preventDefault();
        SearchCountry(document.getElementById("country").value.trim()).then(
            (data) => (document.getElementById("result").innerHTML = data)
          );
        };

}
