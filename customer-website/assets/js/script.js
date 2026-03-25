

// Example JS for interactivity
document.addEventListener("DOMContentLoaded", () => {
  console.log("SRS Electrical Appliances Website Loaded");
});

// Scroll effect: highlight navbar on scroll
document.addEventListener("scroll", function() {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.classList.add("shadow-sm");
  } else {
    navbar.classList.remove("shadow-sm");
  }
});
// Lightbox functionality for gallery
document.addEventListener("DOMContentLoaded", () => {
  const lightboxModal = document.getElementById("lightboxModal");
  const lightboxImage = document.getElementById("lightboxImage");

  document.querySelectorAll(".gallery-img").forEach(img => {
    img.addEventListener("click", () => {
      const imgSrc = img.getAttribute("data-img");
      lightboxImage.src = imgSrc;
    });
  });
});



// product

// Live category filter + search
document.addEventListener("DOMContentLoaded", () => {
  const categoryFilter = document.getElementById("categoryFilter");
  const searchBox = document.getElementById("searchBox");
  const products = document.querySelectorAll(".product-card-wrap");
  const countLabel = document.getElementById("productCount");

  function filterProducts() {
    const cat = categoryFilter.value.toLowerCase();
    const search = searchBox.value.toLowerCase();
    let visibleCount = 0;

    products.forEach(p => {
      const pCat = p.dataset.category.toLowerCase();
      const pName = p.dataset.name;
      const pId = p.dataset.id;

      const matchCat = !cat || pCat === cat;
      const matchSearch = !search || pName.includes(search) || pId.includes(search);

      if (matchCat && matchSearch) {
        p.style.display = "block";
        visibleCount++;
      } else {
        p.style.display = "none";
      }
    });

    countLabel.textContent = `${visibleCount} products found`;
  }

  categoryFilter.addEventListener("change", filterProducts);
  searchBox.addEventListener("input", filterProducts);

  filterProducts(); // Initial run
});



// product details

// Product Image Gallery (click thumbnail to change main image)
document.addEventListener("DOMContentLoaded", () => {
  const mainImage = document.getElementById("mainProductImage");
  const thumbs = document.querySelectorAll(".thumb-img");

  thumbs.forEach(thumb => {
    thumb.addEventListener("click", () => {
      mainImage.src = thumb.src;
    });
  });
});


// about



