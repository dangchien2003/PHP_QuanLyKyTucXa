function appendToDisplay(value) {
    document.getElementById('display').value += value;
  }

  function clearDisplay() {
    document.getElementById('display').value = '';
  }

  function calculateResult() {
    try {
      document.getElementById('display').value = eval(document.getElementById('display').value);
    } catch (error) {
      document.getElementById('display').value = 'Error';
    }
  }

  // Make the calculator draggable
  const calculator = document.getElementById('calculator');
  let isDragging = false;
  let offsetX, offsetY;



let move = false;
document.addEventListener('keydown', (e) => {
  if (e.key === 'Control') {
    move = true;
  }
});

document.addEventListener('keyup', (e) => {
  if (e.key === 'Control') {
    move = false;
  }
});

calculator.addEventListener('mousedown', (e) => {
    if(move) {
      isDragging = true;
      offsetX = e.clientX - calculator.getBoundingClientRect().left;
      offsetY = e.clientY - calculator.getBoundingClientRect().top;
    }
  
});



document.addEventListener('mousemove', (e) => {
  if (isDragging) {
    const calculatorRect = calculator.getBoundingClientRect();
    const isInCalculator = (
      e.clientX >= calculatorRect.left &&
      e.clientX <= calculatorRect.right &&
      e.clientY >= calculatorRect.top &&
      e.clientY <= calculatorRect.bottom
    );

    if (isInCalculator) {
      calculator.style.left = e.clientX - offsetX + 'px';
      calculator.style.top = e.clientY - offsetY + 'px';
    }
  }
});

document.addEventListener('mouseup', () => {
  isDragging = false;
});

$(document).ready(() => {
    let icon_calc = $("#open-calc");
    let calc = $("#calculator");
    let close_calc = $("#close-calc");
    let open = false;
    icon_calc.click(()=> {
        if(!open) {
            $(calc).removeClass('d-none');
            $(close_calc).removeClass("d-none")
            open = true;
        }else {
            $(calc).addClass('d-none');
            $(close_calc).addClass('d-none');
            open = false;
        }
    })
})