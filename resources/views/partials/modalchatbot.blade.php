<!--- Modal Chatbot Component -->
<style>
    .chat-fade-in {
      animation: fadeInUp 0.3s ease-out forwards;
    }

    .chat-fade-out {
      animation: fadeOutDown 0.3s ease-out forwards;
    }

    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeOutDown {
      0% { opacity: 1; transform: translateY(0); }
      100% { opacity: 0; transform: translateY(20px); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    @keyframes blink-dots {
      0%, 20% { content: '.'; }
      40% { content: '..'; }
      60%, 100% { content: '...'; }
    }

    .animate-spin-btn {
      animation: spin 1s linear infinite;
    }

    .thinking-dots::after {
      content: '.';
      animation: blink-dots 1.5s steps(4, end) infinite;
    }

    /* Smooth scroll behavior */
    #chatMessages {
      scroll-behavior: smooth;
    }
  </style>

  <!-- Include Modal Informasi Teks Kosong -->
  @include('partials.modalinformasitextkosong')

  <!-- Chatbot Modal -->
  <div id="chatbotModal" class="hidden fixed bottom-8 right-8 w-[400px] h-[520px] bg-gray-100 rounded-xl shadow-2xl flex flex-col overflow-hidden border border-gray-300 z-50 chat-fade-in">

    <!-- Header -->
    <div class="bg-gray-700 text-white flex items-center justify-between px-4 py-3">
      <div class="flex items-center">
        <img src="{{ asset('img/logo_tms.png') }}" class="w-9 h-9 rounded-full border-2 border-white mr-3" alt="LogoTMS">
        <span class="font-semibold text-base">TechAI</span>
      </div>
      <button onclick="closeChatModal()" class="text-xl hover:text-gray-300 transition">&times;</button>
    </div>

    <!-- Body -->
    <div id="chatMessages" class="flex-1 overflow-y-auto px-4 py-3 space-y-3 text-sm text-gray-800">
      <!-- Initial greeting injected dynamically -->
    </div>

    <!-- Input -->
    <form id="chatForm" class="px-4 py-3 border-t bg-gray-50 flex items-center space-x-2" onsubmit="event.preventDefault(); sendMessage();">
      <input id="chatInput" type="text" placeholder="Type your message..." maxlength="250"
        class="flex-grow max-w-[calc(100%-50px)] px-3 py-2 border border-gray-300 rounded-md text-sm bg-white text-gray-700 focus:outline-none transition" autocomplete="off" />
      <button id="sendBtn" type="submit" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-md text-sm transition flex items-center justify-center">
        <span id="sendIcon">➤</span>
      </button>
    </form>

    <!-- Footer -->
    <div class="text-center px-4 py-2 bg-gray-50 text-[10px] text-gray-500 select-none">
      This chat is recorded. By chatting, you agree to our <a href="#" class="underline hover:text-gray-600">AI Terms</a>.
    </div>
  </div>
  <script>
    // Open Chat Modal
    function openChatModal() {
      const modal = document.getElementById('chatbotModal');
      const chatButton = document.getElementById('chatButton');
      
      // Remove hidden dan fade-out class jika ada
      modal.classList.remove('hidden', 'chat-fade-out');
      
      // Add fade-in animation
      modal.classList.add('chat-fade-in');
      
      // Hide chat button dengan smooth transition
      if (chatButton) {
        chatButton.style.opacity = '0';
        chatButton.style.pointerEvents = 'none';
        setTimeout(() => {
          chatButton.classList.add('hidden');
        }, 300);
      }
      
      document.getElementById('chatInput').focus();
    }

    // Close Chat Modal
    function closeChatModal() {
      const modal = document.getElementById('chatbotModal');
      const chatButton = document.getElementById('chatButton');
      
      // Add fade-out animation
      modal.classList.remove('chat-fade-in');
      modal.classList.add('chat-fade-out');
      
      // Show chat button dengan smooth transition
      if (chatButton) {
        chatButton.classList.remove('hidden');
        chatButton.style.opacity = '0';
        chatButton.style.pointerEvents = 'auto';
        
        // Trigger reflow untuk memastikan transition berjalan
        chatButton.offsetHeight;
        
        setTimeout(() => {
          chatButton.style.transition = 'opacity 0.3s ease-out';
          chatButton.style.opacity = '1';
        }, 10);
      }
      
      // Hide modal setelah animasi selesai
      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('chat-fade-out');
      }, 300);
    }

    // Default AI Response Generator (Fallback jika knowledge.js tidak ditemukan)
    function generateAIResponse(message) {
      const lowerMessage = message.toLowerCase();
      
      // Default responses dengan lebih banyak keywords
      const responses = {
        'halo|hai|hello': 'Halo! Ada yang bisa saya bantu?',
        'siapa|apa itu|tms|technology': 'Saya TechAI, asisten virtual dari Technology Multi Sistem (TMS). Kami adalah penyedia solusi teknologi terdepan yang berdiri sejak 2005.',
        'tentang': 'Kami adalah penyedia solusi teknologi terdepan. Berdiri sejak 2005, TMS telah melayani ratusan klien dengan berbagai solusi digital.',
        'layanan|service|produk|solusi': 'TMS menyediakan berbagai layanan seperti: KOCI, TMS SERVER, UMKM, TASYA, KRESYA, dan KOCI MARKET.',
        'kontak|hubungi|contact|nomor|email': 'Hubungi kami di:\nPhone: 085223035426\nEmail: kocicenter@gmail.com\nAlamat: JL. Ciamis-Banjar Dusun Kidul RT/RW 007/003 Cijeungjing, Ciamis',
        'team|tim|staff': 'Kami memiliki tim profesional yang berpengalaman di bidang teknologi dan inovasi digital.',
        'default': 'Maaf, saya belum memahami pertanyaan Anda. Coba tanyakan tentang: Siapa kami, Layanan, Kontak, atau hal lainnya tentang TMS.'
      };

      // Check keyword matches - improved logic
      for (const [keys, response] of Object.entries(responses)) {
        if (keys !== 'default') {
          const keywordArray = keys.split('|');
          for (const keyword of keywordArray) {
            if (lowerMessage.includes(keyword)) {
              return response;
            }
          }
        }
      }

      for (const [key, response] of Object.entries(responses)) {
        if (key !== 'default' && lowerMessage.includes(key)) {
          return response;
        }
      }

      return responses.default;
    }

    // Auto show welcome message on load
    window.addEventListener('DOMContentLoaded', () => {
      const msgContainer = document.getElementById('chatMessages');
      if (!document.getElementById('welcomeMsg')) {
        const botReply = document.createElement('div');
        botReply.id = 'welcomeMsg';
        botReply.className = 'bg-white border border-gray-300 p-2 rounded-md max-w-[80%] break-words';
        botReply.textContent = "Halo! Saya TechAI, asisten virtual dari Technology Multi Sistem (TMS). Saya siap membantu dan menjawab pertanyaan Anda seputar TMS.";
        msgContainer.appendChild(botReply);
        msgContainer.scrollTop = msgContainer.scrollHeight;
      }
    });

    // Function untuk smooth scroll ke bottom
    function scrollToBottom() {
      const chatBox = document.getElementById('chatMessages');
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    function sendMessage() {
      const input = document.getElementById('chatInput');
      const message = input.value.trim();
      
      // Validasi: jika pesan kosong, tampilkan info modal
      if (!message) {
        openInfoModal();
        return;
      }

      const chatBox = document.getElementById('chatMessages');
      const sendBtn = document.getElementById('sendBtn');
      const sendIcon = document.getElementById('sendIcon');

      input.disabled = true;
      sendBtn.disabled = true;
      sendIcon.textContent = '⟳';
      sendIcon.classList.add('animate-spin-btn');

      const userMsg = document.createElement('div');
      userMsg.className = 'bg-gray-700 text-white p-3 rounded-lg self-end break-words ml-auto max-w-xs';
      userMsg.style.width = 'fit-content';
      userMsg.textContent = message;
      chatBox.appendChild(userMsg);

      input.value = '';
      scrollToBottom();

      const thinking = document.createElement('div');
      thinking.className = 'text-xs text-gray-500 italic thinking-dots';
      thinking.textContent = 'TechAI is thinking';
      thinking.id = 'thinking';
      chatBox.appendChild(thinking);
      scrollToBottom();

      setTimeout(() => {
        const botReply = document.createElement('div');
        botReply.className = 'bg-white border border-gray-300 p-2 rounded-md max-w-[80%] break-words';
        const response = generateAIResponse(message);
        botReply.innerHTML = response.replace(/\n/g, '<br>');

        const thinkingNode = document.getElementById('thinking');
        if (thinkingNode) thinkingNode.remove();

        chatBox.appendChild(botReply);
        scrollToBottom();

        input.disabled = false;
        sendBtn.disabled = false;
        sendIcon.textContent = '➤';
        sendIcon.classList.remove('animate-spin-btn');
        input.focus();
      }, 1200);
    }
  </script>

  <!-- Load Knowledge Base -->
  <script src="{{ asset('js/knowledge.js') }}"></script>
  <script>
    // Ensure knowledge base is loaded before using chatbot
    let knowledgeLoaded = false;
    
    // Check if knowledge.js has loaded
    if (typeof generateAIResponse !== 'undefined') {
      knowledgeLoaded = true;
      console.log('✅ Knowledge base loaded');
    }
  </script>
