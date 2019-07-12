const inputs = document.querySelectorAll('.inputfile');

for (let input of inputs) {
  const label = input.nextElementSibling;
  const labelVal = label.innerHTML;

  input.addEventListener('change', e => {
    let fileName = '';
    if (input.files && input.files.length > 1) {
      fileName = (input.getAttribute('data-multiple-caption') || '').replace('{count}', input.files.length);
    } else {
      fileName = e.target.value.split('\\').pop();
    }

    if (fileName) {
      label.querySelector('span').innerHTML = fileName;
    } else {
      label.innerHTML = labelVal;
    }
  });
}