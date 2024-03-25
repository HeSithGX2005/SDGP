document.addEventListener('DOMContentLoaded', function() {
    // Load materials from backend
    fetch(`${API_URL}/materials`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // Add authorization header if needed
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
    })
    .then(response => response.json())
    .then(materials => {
        const materialSelect = document.getElementById('materialSelect');
        materials.forEach(material => {
            const option = document.createElement('option');
            option.value = material.Material_ID;
            option.textContent = `${material.Material_ID}-${material.Type}`;
            materialSelect.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error loading materials:', error);
    });

    // Initialize datepicker
    $('#DatePicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });    
});

document.getElementById('requestItemForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const materialId = document.getElementById('materialSelect').value;
    const quantity = document.getElementById('quantityInput').value;
    const neededDate = document.getElementById('dateTo').value;
    const supervisorName = document.getElementById('supervisorNameInput').value;

    fetch(`${API_URL}/material_req`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
        body: JSON.stringify({
            Material_ID: materialId,
            Quantity_Requested: quantity,
            Receiving_Date: neededDate,
            Supervisor_Name: supervisorName
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(() => {
        alert('Request submitted successfully');
        this.reset(); // Reset the form after successful submission
    })
    .catch(error => {
        console.error('Error submitting request:', error);
        alert('Error submitting request.');
    });
});


document.addEventListener('DOMContentLoaded', function() {
    fetchMaterials().then(() => {
        // Once materials are fetched and the dropdown is populated, preselect the material
        preselectMaterial();
    });
})
  
  function populateMaterialsDropdown(materials) {
    const materialSelect = document.getElementById('materialSelect');
    materialSelect.innerHTML = ''; // Clear the dropdown before populating
    materials.forEach(material => {
        const option = document.createElement('option');
        option.value = material.Material_ID;
        option.textContent = material.Type;
        materialSelect.appendChild(option);
    });
}

function preselectMaterial() {
    const selectedMaterialId = localStorage.getItem('selectedMaterialType');
    if (selectedMaterialId) {
        const materialSelect = document.getElementById('materialSelect');
        for (const option of materialSelect.options) {
            if (option.value === selectedMaterialId) {
                option.selected = true;
                break;
            }
        }
        // Clear the selected material from localStorage so it doesn't affect subsequent visits
        localStorage.removeItem('selectedMaterialType');
    }
}
  
  