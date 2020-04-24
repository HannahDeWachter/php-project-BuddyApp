document.querySelector("#email").addEventListener("blur",function(){
    //let username= this.dataset.username;
    let email = document.querySelector("#email").Value;

    const formData = new FormData();
    
    
    form.append("email", email);
    
    
    fetch('ajax/register.php', {
      method: 'POST',
      body: formData
    })
    .then((response) => response.json())
    .then((result) => {
      emailCheck.innerHTML('Success:', result);
      console.log(result);
      
    })
    .catch((error) => {
      console.error('Error:', error);
    });

});