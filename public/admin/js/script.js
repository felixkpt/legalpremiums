
function invalidDateRange(action = 'show') {
if (action == 'show') {
let elements = document.querySelectorAll('#selection-form select');
Array.from(elements).forEach((element, index) => {
    element.style.border = '2px solid crimson'
});
return;
}
document.getElementById('selection-form').addEventListener('change', function(e) {
e.target.style.border = '1px solid gray'
})

}