/**
 * Compact Form JavaScript
 * Interactive functionality for professional forms
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize form functionality
    initializeCompactForms();
});

function initializeCompactForms() {
    // Auto-calculate profit
    setupProfitCalculator();

    // Material details calculations
    setupMaterialCalculations();

    // Form validation
    setupFormValidation();

    // Enhanced interactions
    setupFormInteractions();

    // Keyboard shortcuts
    setupKeyboardShortcuts();
}

function setupProfitCalculator() {
    const partyRateInput = document.getElementById('party_rate');
    const supplierRateInput = document.getElementById('supplier_rate');
    const profitInput = document.getElementById('estimated_profit');

    if (!partyRateInput || !supplierRateInput || !profitInput) return;

    function calculateProfit() {
        const partyRate = parseFloat(partyRateInput.value) || 0;
        const supplierRate = parseFloat(supplierRateInput.value) || 0;
        const profit = partyRate - supplierRate;

        profitInput.value = profit.toFixed(2);

        // Visual feedback
        if (profit > 0) {
            profitInput.classList.remove('is-invalid');
            profitInput.classList.add('is-valid');
        } else if (profit < 0) {
            profitInput.classList.remove('is-valid');
            profitInput.classList.add('is-invalid');
        } else {
            profitInput.classList.remove('is-valid', 'is-invalid');
        }
    }

    partyRateInput.addEventListener('input', calculateProfit);
    supplierRateInput.addEventListener('input', calculateProfit);
}

function setupMaterialCalculations() {
    // Auto-calculate totals when material details change
    const materialInputs = document.querySelectorAll('input[name="quantity"], input[name="weight"], input[name="value"]');
    materialInputs.forEach(input => {
        input.addEventListener('input', updateMaterialTotals);
    });

    // Initialize totals
    updateMaterialTotals();
}

function updateMaterialTotals() {
    let totalQty = 0;
    let totalWeight = 0;
    let totalValue = 0;
    let totalPackages = 0;

    // Calculate from existing material rows
    const materialRows = document.querySelectorAll('#material_details tr');
    materialRows.forEach(row => {
        const qty = parseFloat(row.querySelector('input[name="quantity"]')?.value) || 0;
        const weight = parseFloat(row.querySelector('input[name="weight"]')?.value) || 0;
        const value = parseFloat(row.querySelector('input[name="value"]')?.value) || 0;

        totalQty += qty;
        totalWeight += weight;
        totalValue += value;
        totalPackages += 1;
    });

    // Update summary display
    document.getElementById('total_qty').textContent = totalQty;
    document.getElementById('total_weight').textContent = totalWeight.toFixed(2) + ' kg';
    document.getElementById('total_value').textContent = totalValue.toFixed(2);
    document.getElementById('total_packages').textContent = totalPackages;
}

function setupFormValidation() {
    const form = document.querySelector('.compact-form');
    if (!form) return;

    // Real-time validation
    const requiredFields = form.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            validateField(this);
        });

        field.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                validateField(this);
            }
        });
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        let isValid = true;
        requiredFields.forEach(field => {
            if (!validateField(field)) {
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault();
            showNotification('Please fill in all required fields correctly.', 'danger');
        }
    });
}

function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    let message = '';

    // Clear previous validation
    field.classList.remove('is-valid', 'is-invalid');
    const feedback = field.parentNode.querySelector('.invalid-feedback');
    if (feedback) {
        feedback.remove();
    }

    // Required validation
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        message = 'This field is required.';
    }

    // Email validation
    if (field.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            message = 'Please enter a valid email address.';
        }
    }

    // Number validation
    if (field.type === 'number' && value) {
        const numValue = parseFloat(value);
        if (field.min && numValue < parseFloat(field.min)) {
            isValid = false;
            message = `Value must be at least ${field.min}.`;
        }
        if (field.max && numValue > parseFloat(field.max)) {
            isValid = false;
            message = `Value must be at most ${field.max}.`;
        }
    }

    // Apply validation styling
    if (isValid && value) {
        field.classList.add('is-valid');
    } else if (!isValid) {
        field.classList.add('is-invalid');

        // Add feedback message
        const feedbackDiv = document.createElement('div');
        feedbackDiv.className = 'invalid-feedback d-block';
        feedbackDiv.textContent = message;
        field.parentNode.appendChild(feedbackDiv);
    }

    return isValid;
}

function setupFormInteractions() {
    // Auto-focus next field on Enter
    const formFields = document.querySelectorAll('.compact-form input, .compact-form select, .compact-form textarea');
    formFields.forEach((field, index) => {
        field.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                const nextField = formFields[index + 1];
                if (nextField) {
                    nextField.focus();
                }
            }
        });
    });

    // Enhanced select dropdowns
    const selects = document.querySelectorAll('.compact-form .form-select');
    selects.forEach(select => {
        select.addEventListener('change', function() {
            // Add visual feedback
            this.style.borderColor = '#10b981';
            setTimeout(() => {
                this.style.borderColor = '';
            }, 300);
        });
    });

    // Quick reference panel interactions
    const referenceItems = document.querySelectorAll('.cursor-pointer');
    referenceItems.forEach(item => {
        item.addEventListener('click', function() {
            // Add selection effect
            referenceItems.forEach(i => i.classList.remove('selected'));
            this.classList.add('selected');

            // Visual feedback
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
}

function setupKeyboardShortcuts() {
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + S to save draft
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            const saveBtn = document.querySelector('.compact-form .btn-outline-primary');
            if (saveBtn) {
                saveBtn.click();
            }
        }

        // Ctrl/Cmd + Enter to submit
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            const submitBtn = document.querySelector('.compact-form .btn-primary[type="submit"]');
            if (submitBtn) {
                submitBtn.click();
            }
        }

        // Escape to cancel
        if (e.key === 'Escape') {
            const cancelBtn = document.querySelector('.compact-form .btn-outline-secondary');
            if (cancelBtn) {
                cancelBtn.click();
            }
        }
    });
}

// Utility functions
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Export for global use
window.CompactForm = {
    validateField,
    showNotification,
    initializeCompactForms
};