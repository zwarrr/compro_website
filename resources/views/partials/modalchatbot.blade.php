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

    .quick-question-box.clicked {
      opacity: 0;
      transform: scale(0.8);
      pointer-events: none;
      transition: all 0.3s ease;
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

    <!-- Input Area -->
    <form id="chatForm" class="hidden px-4 py-3 border-t bg-gray-50 flex items-center space-x-2" onsubmit="event.preventDefault(); sendMessage();">
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

    // generateAIResponse akan dimuat dari knowledge.js

    // Quick Questions Data - Static
    const quickQuestions = [
      { icon: 'fa-building', text: 'Apa itu TMS?', query: 'apa itu tms', clicked: false },
      { icon: 'fa-list', text: 'Layanan apa saja?', query: 'layanan apa saja', clicked: false },
      { icon: 'fa-phone', text: 'Informasi Kontak', query: 'kontak tms', clicked: false },
      { icon: 'fa-dollar-sign', text: 'Informasi Harga', query: 'harga layanan', clicked: false },
      { icon: 'fa-user-plus', text: 'Cara Mendaftar', query: 'cara daftar', clicked: false },
      { icon: 'fa-clock', text: 'Jam Operasional', query: 'jam operasional', clicked: false },
      { icon: 'fa-info-circle', text: 'Tentang KOCI', query: 'tentang koci', clicked: false },
      { icon: 'fa-star', text: 'Keunggulan TMS', query: 'keunggulan tms', clicked: false },
    ];

    // Function to render quick questions
    function renderQuickQuestions() {
      const chatBox = document.getElementById('chatMessages');
      if (!chatBox) return;

      // Check if quick questions already exist
      const existingQuestions = document.getElementById('quickQuestionsWrapper');
      if (existingQuestions) {
        existingQuestions.remove();
      }

      // Filter only unclicked questions
      const availableQuestions = quickQuestions.filter(q => !q.clicked);
      
      // Jika tidak ada pertanyaan yang tersisa, jangan render
      if (availableQuestions.length === 0) {
        return;
      }

      // Create wrapper
      const wrapper = document.createElement('div');
      wrapper.id = 'quickQuestionsWrapper';
      wrapper.className = 'mt-3';
      
      // Create container with Tailwind
      const container = document.createElement('div');
      container.className = 'grid grid-cols-2 gap-2';
      
      availableQuestions.forEach((q, index) => {
        const questionBox = document.createElement('div');
        questionBox.className = 'bg-white border-2 border-gray-200 rounded-lg p-3 cursor-pointer transition-all duration-300 hover:border-gray-600 hover:bg-gray-50 hover:-translate-y-1 hover:shadow-lg flex items-center gap-2 text-xs';
        questionBox.dataset.query = q.query;
        questionBox.innerHTML = `
          <i class="fas ${q.icon} text-gray-600 text-sm min-w-[18px] text-center"></i>
          <span class="font-medium text-gray-700 leading-tight">${q.text}</span>
        `;
        
        questionBox.addEventListener('click', function() {
          handleQuickQuestion(q, this);
        });
        
        container.appendChild(questionBox);
      });

      wrapper.appendChild(container);
      chatBox.appendChild(wrapper);
      scrollToBottom();
    }

    // Handle quick question click
    function handleQuickQuestion(questionObj, element) {
      // Mark question as clicked
      questionObj.clicked = true;
      
      // Add clicked animation to the specific box
      element.classList.add('clicked');
      
      // Remove the box after animation completes
      setTimeout(() => {
        element.remove();
      }, 300);

      // Set input value and send
      const input = document.getElementById('chatInput');
      input.value = questionObj.query;
      sendMessage();
    }

    // Auto show welcome message and quick questions on load
    window.addEventListener('DOMContentLoaded', () => {
      const msgContainer = document.getElementById('chatMessages');
      if (!document.getElementById('welcomeMsg')) {
        const botReply = document.createElement('div');
        botReply.id = 'welcomeMsg';
        botReply.className = 'bg-white border border-gray-300 p-3 rounded-md max-w-[85%] break-words shadow-sm';
        botReply.innerHTML = `
          <div class="flex items-start gap-2">
            <i class="fas fa-robot text-gray-600 mt-1"></i>
            <div>
              <p class="font-semibold text-gray-800 mb-1">Halo! 👋</p>
              <p class="text-gray-700">Saya <strong>TechAI</strong>, asisten virtual dari Technology Multi System (TMS).</p>
              <p class="text-gray-600 text-xs mt-2">Silakan pilih pertanyaan yang tersedia atau ketik pertanyaan Anda sendiri:</p>
            </div>
          </div>
        `;
        msgContainer.insertBefore(botReply, msgContainer.firstChild);
        
        // Render quick questions
        renderQuickQuestions();
        
        scrollToBottom();
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
      thinking.textContent = 'TechAI sedang memproses';
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

        // Render quick questions setelah jawaban AI
        setTimeout(() => {
          renderQuickQuestions();
        }, 300);

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
    // Memastikan basis pengetahuan telah dimuat sebelum menggunakan chatbot
    let knowledgeLoaded = false;
    
    // Memeriksa apakah knowledge.js telah dimuat
    if (typeof generateAIResponse !== 'undefined') {
      knowledgeLoaded = true;
      console.log('✅ Basis pengetahuan berhasil dimuat');
    }
  </script>
