function showIssueForm(){
    var form = document.getElementById('report-form');
    form.style.display = (form.style.display === 'block') ? 'none' : 'block';
    
}

function addFileInput(){
    const fileInputs = document.getElementById('fileInputs');

    const newFileRow = document.createElement('div');
    newFileRow.classList.add('fileRow');

    const uploadInput = document.createElement('input');
    uploadInput.type = 'file';
    uploadInput.name = 'images[]';
    uploadInput.classList.add('fileInput');
    uploadInput.accept='images/*';

    const descriptionInput = document.createElement('input');
    descriptionInput.type = 'text';
    descriptionInput.name = 'descriptions[]';
    descriptionInput.placeholder = 'Image Description';

    const addButton = document.createElement('button');
    addButton.type = 'button';
    addButton.textContent = 'Add another File';
    addButton.addEventListener('click', addFileInput);

    newFileRow.appendChild(document.createTextNode('Upload Image: '));
    newFileRow.appendChild(uploadInput);
    newFileRow.appendChild(descriptionInput);
    newFileRow.appendChild(addButton);

    fileInputs.appendChild(newFileRow);

    
}

document.getElementById('report-form').addEventListener('submit', function(event){
    event.preventDefault();

    var issue = document.getElementById('issue').value.trim();
    var description = document.getElementById('description').value.trim();
    var priority = document.getElementById('priority').value.trim();
    var department = document.getElementById('department').value.trim();
    var issuedby = document.getElementById('issuedby').value.trim();

    if(issue==='' || description ==='' || priority==='' || department==='' || issuedby===''){

        alert("Please fill all the fields");

    }else{    
        var formData = {
            issue: issue,
            description: description,
            priority: priority,
            department: department,
            issuedby: issuedby
        }

    }   



    fetch('/submit-form', {
        method: 'POST',
        body: JSON.stringify(formData),
        headers: {
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
        
    })
    .then(response=>response.json())
    .then(data=>{
        alert(data.message);
        window.location.href='/';
    })
    .catch(error=>{
        console.error('Error: ', error);
    });
    
});



function uploadFiles(){


}


function sortTable(columnIndex){
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById('reports');
    switching= true;
    var dir = 'asc';

    if(typeof sortOrder[columnIndex]==='undefined' || sortOrder[columnIndex]==='desc'){
        dir='asc';
        sortOrder[columnIndex]='asc';
    }else{
        dir='desc';
        sortOrder[columnIndex]='desc';
    }

    while(switching){
        switching=false;
        rows = table.getElementsByTagName('tr');

        for(i=1;i<(rows.length -1);i++){
            shouldSwitch=false;
            x = rows[i].getElementsByTagName("td")[columnIndex];
            y = rows[i+1].getElementsByTagName("td")[columnIndex];

            if(columnIndex==6||columnIndex==7){
                xValue = new Date(x.innerHTML).getTime();
                yValue = new Date(y.innerHTML).getTime();

            }else{
                var xValue = isNaN(parseInt(x.innerHTML)) ? x.innerHTML.toLowerCase() : parseInt(x.innerHTML);
                var yValue = isNaN(parseInt(y.innerHTML)) ? y.innerHTML.toLowerCase() : parseInt(y.innerHTML);
            }

            if(dir==='asc'){
                if(xValue>yValue){
                    shouldSwitch=true;
                    break;
                }
            }else if(dir==='desc'){

                if(xValue<yValue){
                    shouldSwitch=true;
                    break;
                }
            }
        }    
        if(shouldSwitch){
            rows[i].parentNode.insertBefore(rows[i+1], rows[i]);
            switching=true;
        }
        
    
    }

}


function searchTable(){
    var searchText = document.getElementById('table-search').value;

    fetch('/search',{
        method: 'POST',
        headers: {
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }, 
        body: JSON.stringfy({ searchText: searchText })
    })
    .then(response=> response.json())
    .then(data=>{
        displaySearchResult(data);
    })
    .catch(error=> {
        console.error('Error: ', error);
    });
}

function displaySearchResult(){
    
    var searchResultContainer = document.getElementById('searchResult');
    searchResultContainer.innerHTML='THIS IS THE RESULT';
    data.forEach(item=>{
        searchResultContainer.innerHTML += '<p>${item.description}</p>'
    });
}


