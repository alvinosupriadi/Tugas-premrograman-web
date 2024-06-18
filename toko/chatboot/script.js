const chatbotMessages = document.getElementById('chatbot-messages');
const userInput = document.getElementById('user-input');

const responses = {
    "halo": "Halo! Ada yang bisa saya bantu?",
    "jam buka": "Toko kami buka setiap hari dari jam 9 pagi hingga 9 malam.",
    "alamat": "Kami berlokasi di Jl. Contoh No. 123, Jakarta.",
    "apakah stok masih ada?": "Untuk informasi stok produk, silakan sebutkan nama atau tipe produk yang Anda cari.",
    "terima kasih": "Sama-sama! Jika ada pertanyaan lain, jangan ragu untuk bertanya, atau jika jawaban dari kami kurang memuaskan silahkan menghubungi admin melalui halaman kontak"
};

function sendMessage() {
    const message = userInput.value.trim();
    if (message) {
        addMessage(message, 'user');
        userInput.value = '';
        respondToMessage(message.toLowerCase());
    }
}

function addMessage(message, sender) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('message', sender);
    messageElement.textContent = message;
    chatbotMessages.appendChild(messageElement);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
}

function respondToMessage(message) {
    const response = responses[message] || "Maaf, saya tidak mengerti pertanyaan Anda. Silakan coba pertanyaan lain.";
    setTimeout(() => {
        addMessage(response, 'bot');
    }, 500);
}

// Inisialisasi dengan pesan sambutan
addMessage("Selamat datang di toko laptop kami! Ada yang bisa saya bantu?", 'bot');
