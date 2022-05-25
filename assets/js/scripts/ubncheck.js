import $ from "jquery";

export function ubncheck() {
    if ( $( "#submitbutton" ).length ) {
    
        var submitbutton = document.getElementById("submitbutton");
        
        submitbutton.onclick = function(e) {
            e.preventDefault();
            
            $('#ubnoutput').html('');
            var ubn = document.getElementById("ubn").value;
            
            $.getJSON('https://api.mijnwestfort.nl/company/status/' + ubn, function(data) {
               var ubndata = '';
               
               // ITERATING THROUGH OBJECTS
               $.each(data, function (key, value) {
               
                   //CONSTRUCTION OF ROWS HAVING
                   // DATA FROM JSON OBJECT
                   ubndata += '<table><tr><td>UBN:</td><td>' + 
                       value.ubn + '</td></tr>';
               
                   ubndata += '<tr><td>Status:</td><td>' + 
                       value.status + '</td></tr>';
               
                   ubndata += '<tr><td>Concept:</td><td>' + 
                       value.concept + '</td></tr></table>';
               
               });
                 
               //INSERTING ROWS INTO TABLE 
               $('#ubnoutput').html('').append(ubndata);
            });
            
            
        }
    }
}