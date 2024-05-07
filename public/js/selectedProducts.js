    // Select all checkboxes with the name "product[]"
    const checkboxes = document.querySelectorAll('input[name="product[]"]');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Select all checked checkboxes
            const selectedProducts = document.querySelectorAll('input[name="product[]"]:checked');
            
            // Clear the quantity fields container
            const quantityFields = document.getElementById('quantity-fields');
            quantityFields.innerHTML = '';
            
            // Iterate over the checked checkboxes
            selectedProducts.forEach(checkbox => {
                const productId = checkbox.value;
                const productName = checkbox.nextElementSibling.textContent;
                
                const label = document.createElement('label');
                label.textContent = 'Quantity for ' + productName + ': ';
                
                // Create quantity input
                const input = document.createElement('input');
                input.type = 'number';
                input.name = 'quantities[' + productId + ']';
                input.min = '1000'; 
                input.value = '1000'; 
                input.classList.add('form-control');
                
                // Append label and input to quantity fields container
                quantityFields.appendChild(label);
                quantityFields.appendChild(input);
            });
        });
    });
