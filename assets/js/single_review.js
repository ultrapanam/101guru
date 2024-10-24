// document.addEventListener("DOMContentLoaded", function () {
//     // Select the last child element
//     const lastChild = document.querySelector(".review-list .last-child");

//     if (lastChild) {
//         // Get the item count from the data attribute
//         const itemCount = parseInt(lastChild.getAttribute('data-count'), 10);

//         // Determine the number of columns the last child should span
//         let columns = 3; // Default number of columns on larger screens
//         if (window.innerWidth <= 768) {
//             columns = 2;
//         }
//         if (window.innerWidth <= 480) {
//             columns = 1;
//         }

//         // Set the grid-column span based on the number of items
//         if (itemCount % columns !== 0) {
//             const span = columns - (itemCount % columns) + 1;
//             lastChild.style.gridColumn = `span ${span}`;
//         } else {
//             lastChild.style.gridColumn = `span ${columns}`;
//         }
//     }
// });
