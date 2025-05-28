import './bootstrap';
document.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname.includes('/admin')) {
        fetchCategories();
        fetchBrands();
    }
});

function fetchCategories() {
    fetch('/admin/categories/list')
        .then(res => res.json())
        .then(data => {
            const select = document.querySelector('select[name="category_id"]');
            if (select) {
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    select.appendChild(option);
                });
            }
        });
}

function fetchBrands() {
    fetch('/admin/brands/list')
        .then(res => res.json())
        .then(data => {
            const select = document.querySelector('select[name="brand_id"]');
            if (select) {
                data.forEach(brand => {
                    const option = document.createElement('option');
                    option.value = brand.id;
                    option.textContent = brand.name;
                    select.appendChild(option);
                });
            }
        });
}
