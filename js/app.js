document.querySelector("#email").addEventListener("blur",function(){
    //let username= this.dataset.username;
    let email = document.querySelector("#email").value;

    const formData = new FormData();
    
    
    formData.append("email", email);
    
    
    fetch('ajax/register.php', {
      method: 'POST',
      body: formData
    })
    .then((response) => response.json())
    .then((result) => {
      console.log(result);
      const emailCheck = document.querySelector("#emailCheck");

      if (result["status"] === "success") {
        emailCheck.innerHTML = "<p style='color: green;'>Available.</p>";
      } else if (result["status"] === "warning") {
        emailCheck.innerHTML =
          "<p style='color: red;'>Email has to end with @student.thomasmore.be</p>";
      } else {
        emailCheck.innerHTML =
          "<p style='color: red;'>Not Available.</p>";
      }

    })
    .catch((error) => {
      console.error('Error:', error);
    });

});