function reloadPage() {
  sessionStorage.clear();
  location.reload();
}

    // Get references to the select boxes
  var contractorSelect = document.getElementById('contractor');
  var letterSelect = document.getElementById('letter');

  // Define the event listener for the contractor select box
  contractorSelect.addEventListener('change', function() {
    // Clear existing options in the letter select box
    letterSelect.innerHTML = '<option selected disabled value="">Select Letter No</option>';

    // Get the selected contractor
    var selectedContractor = contractorSelect.value;

    // Fetch the letter numbers corresponding to the selected contractor
    fetch('fetch_letters.php?contractor=' + selectedContractor)
      .then(response => response.json())
      .then(data => {
        // Add the fetched letter numbers as options to the letter select box
        data.forEach(function(letter) {
          var option = document.createElement('option');
          option.value = letter;
          option.textContent = letter;
          letterSelect.appendChild(option);
        });
      })
      .catch(error => {
        console.error('Error:', error);
      });
  });


