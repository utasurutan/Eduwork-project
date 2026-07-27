// ==========================================================
// 1a. ARRAY DATA PRODUK
// Setiap produk punya: nama, harga, deskripsi, gambar, kategori, rating
// ==========================================================
const products = [
  {
    id: 1,
    name: "Tas Ransel Canvas Motif Logo",
    price: 850000,
    description: "Tas ransel bahan canvas dengan motif print logo, muat laptop 14 inch, tali adjustable.",
    category: "tas",
    rating: 4.6,
    ratingCount: 214,
    image: "images/tas-chanel.webp"
  },
  {
    id: 2,
    name: "Maison Margiela Scarf Ribbed Knit",
    price: 1250000,
    description: "Syal rajut ribbed dengan detail signature numbering, bahan lembut dan hangat.",
    category: "aksesoris",
    rating: 4.8,
    ratingCount: 97,
    image: "images/margiela-scarf.webp"
  },
  {
    id: 3,
    name: "Maison Margiela GAT Sneakers",
    price: 3200000,
    description: "Sneakers low-top dengan aksen distressed dan detail warna kontras, gaya vintage-sporty.",
    category: "sepatu",
    rating: 4.7,
    ratingCount: 156,
    image: "images/margiela-gats.webp"
  },
  {
    id: 4,
    name: "Beanie England Retro Umbro",
    price: 175000,
    description: "Kupluk rajut motif logo timnas England, gaya retro, hangat dipakai musim dingin.",
    category: "aksesoris",
    rating: 4.5,
    ratingCount: 342,
    image: "images/england-beanie.webp"
  }
];

// ==========================================================
// STATE
// ==========================================================
let currentCategory = "semua";
let currentSearch = "";
let cartCount = 0;

const productGrid = document.getElementById("productGrid");
const emptyState = document.getElementById("emptyState");
const sectionTitle = document.getElementById("sectionTitle");
const productCount = document.getElementById("productCount");
const cartCountEl = document.getElementById("cartCount");
const searchInput = document.getElementById("searchInput");
const searchBtn = document.getElementById("searchBtn");
const filterButtons = document.querySelectorAll(".filter-btn");

// Label kategori untuk judul section
const categoryLabels = {
  "semua": "Semua Produk",
  "tas": "Tas",
  "sepatu": "Sepatu",
  "aksesoris": "Aksesoris"
};

// ==========================================================
// 1b. RENDER PRODUK KE HALAMAN DENGAN LOOPING
// ==========================================================
function formatRupiah(number) {
  return number.toLocaleString("id-ID");
}

function renderStars(rating) {
  const fullStars = Math.round(rating);
  return "★".repeat(fullStars) + "☆".repeat(5 - fullStars);
}

function renderProducts(list) {
  productGrid.innerHTML = ""; // kosongkan grid sebelum render ulang

  if (list.length === 0) {
    emptyState.style.display = "block";
    productGrid.style.display = "none";
    return;
  }

  emptyState.style.display = "none";
  productGrid.style.display = "grid";

  // Looping array produk, tiap produk dibuat jadi satu card
  list.forEach(function (product) {
    const card = document.createElement("div");
    card.className = "product-card";

    card.innerHTML = `
      <div class="product-image-wrap">
        <img src="${product.image}" alt="${product.name}" onerror="this.src='https://via.placeholder.com/200x180.png?text=Gambar+Produk'">
      </div>
      <span class="product-badge">${categoryLabels[product.category]}</span>
      <h3 class="product-name">${product.name}</h3>
      <div class="product-rating">
        ${renderStars(product.rating)}
        <span>(${product.ratingCount})</span>
      </div>
      <p class="product-desc">${product.description}</p>
      <p class="product-price">${formatRupiah(product.price)}</p>
      <button class="add-to-cart-btn" data-id="${product.id}">Masukkan Keranjang</button>
    `;

    productGrid.appendChild(card);
  });

  // Pasang event listener untuk tombol "Masukkan Keranjang"
  document.querySelectorAll(".add-to-cart-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      cartCount++;
      cartCountEl.textContent = cartCount;
    });
  });
}

// ==========================================================
// 2. FITUR FILTER BERDASARKAN KATEGORI
// ==========================================================
function applyFilters() {
  let filtered = products;

  // filter kategori
  if (currentCategory !== "semua") {
    filtered = filtered.filter(function (p) {
      return p.category === currentCategory;
    });
  }

  // filter pencarian (bonus, berdasarkan nama produk)
  if (currentSearch.trim() !== "") {
    const keyword = currentSearch.toLowerCase();
    filtered = filtered.filter(function (p) {
      return p.name.toLowerCase().includes(keyword);
    });
  }

  sectionTitle.textContent = categoryLabels[currentCategory];
  productCount.textContent = filtered.length + " produk ditemukan";

  renderProducts(filtered);
}

filterButtons.forEach(function (btn) {
  btn.addEventListener("click", function () {
    filterButtons.forEach(function (b) { b.classList.remove("active"); });
    btn.classList.add("active");
    currentCategory = btn.dataset.category;
    applyFilters();
  });
});

searchBtn.addEventListener("click", function () {
  currentSearch = searchInput.value;
  applyFilters();
});

searchInput.addEventListener("keyup", function (e) {
  if (e.key === "Enter") {
    currentSearch = searchInput.value;
    applyFilters();
  }
});

// ==========================================================
// INIT — render pertama kali saat halaman dibuka
// ==========================================================
applyFilters();
