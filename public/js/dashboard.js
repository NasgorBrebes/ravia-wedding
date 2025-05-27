// Global variables
let guestEditId = null;
let deleteGuestId = null;
let myToast;
let guestModal;
let deleteModal;

// Initialize when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Initialize Bootstrap components
    myToast = new bootstrap.Toast(document.getElementById("successToast"));
    guestModal = new bootstrap.Modal(document.getElementById("guestModal"));
    deleteModal = new bootstrap.Modal(
        document.getElementById("deleteConfirmModal")
    );

    // Setup confirm delete button
    document
        .getElementById("confirmDeleteBtn")
        .addEventListener("click", function () {
            confirmDeleteGuest();
        });

    // Setup mobile sidebar toggle
    document
        .getElementById("sidebarToggle")
        .addEventListener("click", function () {
            toggleSidebar();
        });

    // Check if user is logged in
    checkLogin();

    // Load dashboard data
    loadDashboardData();
});

// Login Functions
function login() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // For demo purposes - in production, this should be a secure API call
    if (username === "admin" && password === "password") {
        // Store login state in session storage
        sessionStorage.setItem("isLoggedIn", "true");
        sessionStorage.setItem("userName", username);

        // Show dashboard
        showDashboard();
    } else {
        // Show error
        document.getElementById("loginError").style.display = "block";
    }
}

function checkLogin() {
    const isLoggedIn = sessionStorage.getItem("isLoggedIn");
    if (isLoggedIn === "true") {
        showDashboard();

        // Set user display name
        const userName = sessionStorage.getItem("userName");
        if (userName) {
            document.getElementById("userDisplayName").textContent = userName;
        }
    }
}

function logout() {
    // Clear session storage
    sessionStorage.removeItem("isLoggedIn");
    sessionStorage.removeItem("userName");

    // Show login page
    document.getElementById("dashboardPage").classList.add("d-none");
    document.getElementById("loginPage").classList.remove("d-none");
}

function showDashboard() {
    document.getElementById("loginPage").classList.add("d-none");
    document.getElementById("dashboardPage").classList.remove("d-none");
}

// Navigation Functions
function showSection(sectionName) {
    // Hide all sections
    document.getElementById("dashboardSection").classList.add("d-none");
    document.getElementById("guestsSection").classList.add("d-none");
    document.getElementById("editWebSection").classList.add("d-none");

    // Update navigation active state
    const navLinks = document.querySelectorAll(".nav-link");
    navLinks.forEach((link) => link.classList.remove("active"));

    // Show selected section and activate corresponding nav link
    switch (sectionName) {
        case "dashboard":
            document
                .getElementById("dashboardSection")
                .classList.remove("d-none");
            document
                .querySelector(
                    ".nav-link[onclick=\"showSection('dashboard')\"]"
                )
                .classList.add("active");
            document.querySelector("h1.h2").textContent = "Dashboard";
            break;
        case "guests":
            document.getElementById("guestsSection").classList.remove("d-none");
            document
                .querySelector(".nav-link[onclick=\"showSection('guests')\"]")
                .classList.add("active");
            document.querySelector("h1.h2").textContent = "Daftar Tamu";
            loadGuests();
            break;
        case "editWeb":
            document
                .getElementById("editWebSection")
                .classList.remove("d-none");
            document
                .querySelector(".nav-link[onclick=\"showSection('editWeb')\"]")
                .classList.add("active");
            document.querySelector("h1.h2").textContent = "Edit Website";
            break;
    }

    // Close sidebar on mobile after selection
    if (window.innerWidth < 768) {
        document.getElementById("sidebar").classList.remove("show");
    }
}

// Toggle sidebar on mobile
function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("show");
}

// Dashboard Data Functions
function loadDashboardData() {
    // This would typically be an API call
    // For demo purposes, we'll use the static data from HTML
    updateGuestStats();
    loadRecentActivities();
}

function updateGuestStats() {
    // In a real application, these values would come from an API
    const totalGuests = 150;
    const confirmedGuests = 87;
    const declinedGuests = 23;
    const pendingGuests = totalGuests - confirmedGuests - declinedGuests;

    document.getElementById("totalGuests").textContent = totalGuests;
    document.getElementById("confirmedGuests").textContent = confirmedGuests;
    document.getElementById("declinedGuests").textContent = declinedGuests;
    document.getElementById("pendingGuests").textContent = pendingGuests;
}

function loadRecentActivities() {
    // In a real application, this data would come from an API
    // The HTML already has static examples
}

// Guest Management Functions
function loadGuests() {
    // In a real application, this would be an API call to get guests
    // The HTML already has static examples
}

function editGuestModal(id) {
    guestEditId = id;

    // Fetch guest data - in a real app, this would be an API call
    // For demo, we'll simulate with hardcoded data
    let guestData;

    switch (id) {
        case 1:
            guestData = {
                name: "Agus Setiawan",
                email: "agus@example.com",
                phone: "0812-3456-7890",
                address: "Jl. Merdeka No. 123, Jakarta",
                status: "confirmed",
            };
            break;
        case 2:
            guestData = {
                name: "Budi Santoso",
                email: "budi@example.com",
                phone: "0813-2345-6789",
                address: "Jl. Sudirman No. 45, Jakarta",
                status: "confirmed",
            };
            break;
        case 3:
            guestData = {
                name: "Citra Dewi",
                email: "citra@example.com",
                phone: "0857-1234-5678",
                address: "Jl. Gatot Subroto No. 67, Jakarta",
                status: "declined",
            };
            break;
        case 4:
            guestData = {
                name: "Dewi Putri",
                email: "dewi@example.com",
                phone: "0822-3456-7890",
                address: "Jl. Thamrin No. 89, Jakarta",
                status: "pending",
            };
            break;
        default:
            guestData = {
                name: "",
                email: "",
                phone: "",
                address: "",
                status: "pending",
            };
    }

    // Fill form with guest data
    document.getElementById("guestModalLabel").textContent = "Edit Tamu";
    document.getElementById("guestId").value = id;
    document.getElementById("guestName").value = guestData.name;
    document.getElementById("guestEmail").value = guestData.email;
    document.getElementById("guestPhone").value = guestData.phone;
    document.getElementById("guestAddress").value = guestData.address;
    document.getElementById("guestStatus").value = guestData.status;

    // Show modal
    guestModal.show();
}

function deleteGuest(id) {
    deleteGuestId = id;
    deleteModal.show();
}

function confirmDeleteGuest() {
    // In a real application, this would be an API call
    console.log(`Deleting guest with ID: ${deleteGuestId}`);

    // Close modal
    deleteModal.hide();

    // Show success message
    showToast("Tamu berhasil dihapus!");

    // Remove the guest from the table (in a real app, you'd reload data)
    const guestElement = document.querySelector(
        `#guestsList tr button[onclick="deleteGuest(${deleteGuestId})"]`
    ).parentNode.parentNode;
    guestElement.remove();

    // Update stats
    updateGuestStats();
}

function saveGuest() {
    const guestId = document.getElementById("guestId").value;
    const guestName = document.getElementById("guestName").value;
    const guestEmail = document.getElementById("guestEmail").value;
    const guestPhone = document.getElementById("guestPhone").value;
    const guestAddress = document.getElementById("guestAddress").value;
    const guestStatus = document.getElementById("guestStatus").value;

    // Validate form
    if (!guestName || !guestEmail || !guestPhone) {
        alert("Silakan isi semua field yang diperlukan!");
        return;
    }

    // Prepare guest data
    const guestData = {
        id: guestId || Date.now(), // Use existing ID or generate new one
        name: guestName,
        email: guestEmail,
        phone: guestPhone,
        address: guestAddress,
        status: guestStatus,
    };

    // In a real application, this would be an API call
    console.log("Saving guest:", guestData);

    // Close modal
    guestModal.hide();

    // Reset form
    document.getElementById("guestForm").reset();
    document.getElementById("guestId").value = "";
    document.getElementById("guestModalLabel").textContent = "Tambah Tamu";

    // Show success message
    showToast("Tamu berhasil disimpan!");

    // Update guest list (in a real app, you'd reload data)
    // Here we're just updating existing or adding new guest to the table
    if (guestEditId) {
        updateGuestInTable(guestData);
    } else {
        addGuestToTable(guestData);
    }

    // Reset edit ID
    guestEditId = null;

    // Update stats
    updateGuestStats();
}

function addGuestToTable(guestData) {
    const guestsList = document.getElementById("guestsList");
    const newRow = document.createElement("tr");

    // Set badge class based on status
    let badgeClass = "bg-warning text-dark";
    let statusText = "Menunggu";

    if (guestData.status === "confirmed") {
        badgeClass = "bg-success";
        statusText = "Hadir";
    } else if (guestData.status === "declined") {
        badgeClass = "bg-danger";
        statusText = "Tidak Hadir";
    }

    newRow.innerHTML = `
        <td>${guestData.name}</td>
        <td>${guestData.email}</td>
        <td class="d-none d-md-table-cell">${guestData.phone}</td>
        <td><span class="badge ${badgeClass} status-badge">${statusText}</span></td>
        <td>
            <button class="btn btn-sm btn-outline-primary me-1" onclick="editGuestModal(${guestData.id})">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-outline-danger" onclick="deleteGuest(${guestData.id})">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;

    guestsList.appendChild(newRow);
}

function updateGuestInTable(guestData) {
    // Find the row and update values
    const row = document.querySelector(
        `#guestsList tr button[onclick="editGuestModal(${guestData.id})"]`
    ).parentNode.parentNode;

    // Set badge class based on status
    let badgeClass = "bg-warning text-dark";
    let statusText = "Menunggu";

    if (guestData.status === "confirmed") {
        badgeClass = "bg-success";
        statusText = "Hadir";
    } else if (guestData.status === "declined") {
        badgeClass = "bg-danger";
        statusText = "Tidak Hadir";
    }

    // Update row cells
    row.cells[0].textContent = guestData.name;
    row.cells[1].textContent = guestData.email;
    row.cells[2].textContent = guestData.phone;
    row.cells[3].innerHTML = `<span class="badge ${badgeClass} status-badge">${statusText}</span>`;
}

// Web Settings Functions
function saveWebSettings() {
    // Get form values
    const webTitle = document.getElementById("webTitle").value;
    const themeColor = document.getElementById("themeColor").value;
    const weddingDate = document.getElementById("weddingDate").value;
    const weddingTime = document.getElementById("weddingTime").value;
    const weddingVenue = document.getElementById("weddingVenue").value;
    const groomName = document.getElementById("groomName").value;
    const brideName = document.getElementById("brideName").value;
    const groomParents = document.getElementById("groomParents").value;
    const brideParents = document.getElementById("brideParents").value;
    const weddingStory = document.getElementById("weddingStory").value;

    // Validate form
    if (!webTitle || !weddingDate || !weddingTime || !groomName || !brideName) {
        alert("Silakan isi semua field yang diperlukan!");
        return;
    }

    // Prepare settings data
    const webSettings = {
        title: webTitle,
        theme: themeColor,
        date: weddingDate,
        time: weddingTime,
        venue: weddingVenue,
        groom: groomName,
        bride: brideName,
        groomParents: groomParents,
        brideParents: brideParents,
        story: weddingStory,
    };

    // In a real application, this would be an API call
    console.log("Saving web settings:", webSettings);

    // Show success message
    showToast("Pengaturan berhasil disimpan!");
}

// Export Functions
function exportGuestList() {
    // In a real application, this would generate a CSV/Excel file
    alert("Fitur export akan mengunduh data tamu dalam format CSV/Excel");
}

// Utility Functions
function showToast(message) {
    document.getElementById("toastMessage").textContent = message;
    myToast.show();
}
