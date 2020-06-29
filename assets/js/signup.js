const yearsTag = document.querySelector('#years');
const monthsTag = document.querySelector('#months');
const daysTag = document.querySelector('#days');
const currentYear = new Date().getFullYear();

const init = (parent, tag, i) => {
    const option = document.createElement(tag);
    option.innerHTML = i;
    parent.append(option);
}

const updateDays = () => {
    daysTag.innerHTML = '';
    const currentYear = yearsTag.selectedIndex === -1 ? new Date().getFullYear() : yearsTag.value;
    const currentMonth = monthsTag.selectedIndex === -1 ? 1 : monthsTag.value;
    const days =new Date(currentYear, currentMonth,0).getDate();
    for (let i = 1; i <= days; i++) init(daysTag, 'option', i);
}
for (let i = currentYear; i > 1900; i--) init(yearsTag, 'option', i);
for (let i = 1; i <= 12; i++) init(monthsTag, 'option', i);
updateDays();
yearsTag.addEventListener('change',updateDays);
monthsTag.addEventListener('change',updateDays);