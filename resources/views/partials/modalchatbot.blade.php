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
    // State management untuk chatbot
    let chatState = {
      currentStep: 'categories', // categories, subCategories, answer
      selectedCategory: null,
      selectedSubCategory: null,
      categories: [],
      subCategories: [],
      currentAnswer: null
    };

    // Open Chat Modal
    function openChatModal() {
      const modal = document.getElementById('chatbotModal');
      const chatButton = document.getElementById('chatButton');
      
      modal.classList.remove('hidden', 'chat-fade-out');
      modal.classList.add('chat-fade-in');
      
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
      
      modal.classList.remove('chat-fade-in');
      modal.classList.add('chat-fade-out');
      
      if (chatButton) {
        chatButton.classList.remove('hidden');
        chatButton.style.opacity = '0';
        chatButton.style.pointerEvents = 'auto';
        
        chatButton.offsetHeight;
        
        setTimeout(() => {
          chatButton.style.transition = 'opacity 0.3s ease-out';
          chatButton.style.opacity = '1';
        }, 10);
      }
      
      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('chat-fade-out');
      }, 300);
    }

    // Fetch categories dari API
    async function loadCategories() {
      try {
        const response = await fetch('/api/pengetahuan/categories');
        const result = await response.json();
        if (result.success) {
          chatState.categories = result.data;
          renderCategories();
        }
      } catch (error) {
        console.error('Error loading categories:', error);
      }
    }

    // Render categories
    function renderCategories() {
      const chatBox = document.getElementById('chatMessages');
      const existingCategories = document.getElementById('categoriesWrapper');
      if (existingCategories) {
        existingCategories.remove();
      }

      const wrapper = document.createElement('div');
      wrapper.id = 'categoriesWrapper';
      wrapper.className = 'mt-3';
      
      const container = document.createElement('div');
      container.className = 'grid grid-cols-2 gap-2';
      
      chatState.categories.forEach(category => {
        const categoryBox = document.createElement('div');
        categoryBox.className = 'bg-white border-2 border-gray-200 rounded-lg p-3 cursor-pointer transition-all duration-300 hover:border-gray-600 hover:bg-gray-50 hover:-translate-y-1 hover:shadow-lg text-xs font-medium text-gray-700 text-center';
        categoryBox.textContent = category;
        
        categoryBox.addEventListener('click', function() {
          selectCategory(category);
        });
        
        container.appendChild(categoryBox);
      });

      wrapper.appendChild(container);
      chatBox.appendChild(wrapper);
      scrollToBottom();
    }

    // Select category dan load sub categories
    async function selectCategory(category) {
      chatState.selectedCategory = category;
      chatState.currentStep = 'subCategories';

      const chatBox = document.getElementById('chatMessages');
      
      // Add user selection message
      const userMsg = document.createElement('div');
      userMsg.className = 'bg-gray-700 text-white p-3 rounded-lg self-end break-words ml-auto max-w-xs';
      userMsg.style.width = 'fit-content';
      userMsg.textContent = category;
      chatBox.appendChild(userMsg);

      // Remove categories wrapper
      const wrapper = document.getElementById('categoriesWrapper');
      if (wrapper) wrapper.remove();

      // Add bot response
      const botMsg = document.createElement('div');
      botMsg.className = 'bg-white border border-gray-300 p-2 rounded-md';
      botMsg.innerHTML = `<i class="fas fa-arrow-right text-gray-600 mr-2"></i><strong>Pilih sub kategori:</strong>`;
      chatBox.appendChild(botMsg);

      scrollToBottom();

      // Fetch sub categories
      try {
        const response = await fetch(`/api/pengetahuan/sub-categories/${encodeURIComponent(category)}`);
        const result = await response.json();
        if (result.success) {
          chatState.subCategories = result.data;
          renderSubCategories();
        }
      } catch (error) {
        console.error('Error loading sub categories:', error);
      }
    }

    // Parse markdown dan special characters
    function parseMarkdown(text) {
      if (!text) return '';
      
      // Escape HTML special characters
      text = text
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
      
      // Convert \n to <br>
      text = text.replace(/\\n/g, '<br>');
      text = text.replace(/\n/g, '<br>');
      
      // Bold: **text** atau __text__
      text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
      text = text.replace(/__(.*?)__/g, '<strong>$1</strong>');
      
      // Italic: *text* atau _text_
      text = text.replace(/\*(.*?)\*/g, '<em>$1</em>');
      text = text.replace(/_(.*?)_/g, '<em>$1</em>');
      
      // Bullet points: - text atau * text
      text = text.replace(/^[\s]*[-*]\s+(.+)$/gm, '<li>$1</li>');
      text = text.replace(/(<li>.*<\/li>)/s, '<ul class="list-disc list-inside ml-2">$1</ul>');
      
      // Numbered list: 1. text
      text = text.replace(/^[\s]*\d+\.\s+(.+)$/gm, '<li>$1</li>');
      text = text.replace(/(<li>.*<\/li>)/s, '<ol class="list-decimal list-inside ml-2">$1</ol>');
      
      // Links: [text](url)
      text = text.replace(/\[(.*?)\]\((.*?)\)/g, '<a href="$2" target="_blank" class="text-blue-600 underline">$1</a>');
      
      // Emojis dan special formatting - preserve them
      return text;
    }

    // Render sub categories
    function renderSubCategories() {
      const chatBox = document.getElementById('chatMessages');
      const existingSubCats = document.getElementById('subCategoriesWrapper');
      if (existingSubCats) {
        existingSubCats.remove();
      }

      const wrapper = document.createElement('div');
      wrapper.id = 'subCategoriesWrapper';
      wrapper.className = 'mt-3';
      
      const container = document.createElement('div');
      container.className = 'space-y-2';
      
      chatState.subCategories.forEach(subCategory => {
        const subCatBox = document.createElement('div');
        subCatBox.className = 'bg-gray-50 border-l-4 border-gray-700 p-2 cursor-pointer transition-all hover:bg-gray-100 hover:shadow-md text-xs font-medium text-gray-700';
        subCatBox.innerHTML = `<i class="fas fa-check-circle text-gray-700 mr-2"></i>${subCategory}`;
        
        subCatBox.addEventListener('click', function() {
          selectSubCategory(subCategory);
        });
        
        container.appendChild(subCatBox);
      });

      wrapper.appendChild(container);
      chatBox.appendChild(wrapper);
      scrollToBottom();
    }

    // Select sub category dan get answer
    async function selectSubCategory(subCategory) {
      chatState.selectedSubCategory = subCategory;
      chatState.currentStep = 'answer';

      const chatBox = document.getElementById('chatMessages');
      
      // Add user selection message
      const userMsg = document.createElement('div');
      userMsg.className = 'bg-gray-700 text-white p-3 rounded-lg self-end break-words ml-auto max-w-xs';
      userMsg.style.width = 'fit-content';
      userMsg.textContent = subCategory;
      chatBox.appendChild(userMsg);

      // Remove sub categories wrapper
      const wrapper = document.getElementById('subCategoriesWrapper');
      if (wrapper) wrapper.remove();

      // Add loading message
      const thinking = document.createElement('div');
      thinking.className = 'text-xs text-gray-500 italic thinking-dots';
      thinking.textContent = 'TechAI sedang memproses';
      thinking.id = 'thinking';
      chatBox.appendChild(thinking);
      scrollToBottom();

      // Fetch answer
      try {
        const response = await fetch(`/api/pengetahuan/answer/${encodeURIComponent(chatState.selectedCategory)}/${encodeURIComponent(subCategory)}`);
        const result = await response.json();
        
        if (thinking) thinking.remove();

        if (result.success) {
          const botReply = document.createElement('div');
          botReply.className = 'bg-white border border-gray-300 p-3 rounded-md max-w-[85%] break-words';
          botReply.innerHTML = parseMarkdown(result.data.jawaban);
          chatBox.appendChild(botReply);

          chatState.currentAnswer = result.data;

          // Add research button after answer
          setTimeout(() => {
            renderResearchButton();
          }, 300);
        }
      } catch (error) {
        console.error('Error loading answer:', error);
        if (thinking) thinking.remove();
      }

      scrollToBottom();
    }

    // Render research button (untuk kembali ke kategori)
    function renderResearchButton() {
      const chatBox = document.getElementById('chatMessages');
      const existingResearch = document.getElementById('researchWrapper');
      if (existingResearch) {
        existingResearch.remove();
      }

      const wrapper = document.createElement('div');
      wrapper.id = 'researchWrapper';
      wrapper.className = 'mt-3 flex gap-2';
      
      const researchBtn = document.createElement('button');
      researchBtn.className = 'flex-1 bg-gray-700 hover:bg-gray-800 text-white p-2 rounded-md text-xs font-medium transition';
      researchBtn.innerHTML = '<i class="fas fa-microscope mr-1"></i>Riset';
      researchBtn.addEventListener('click', resetChatCompletely);

      const newQuesBtn = document.createElement('button');
      newQuesBtn.className = 'flex-1 bg-gray-600 hover:bg-gray-700 text-white p-2 rounded-md text-xs font-medium transition';
      newQuesBtn.innerHTML = '<i class="fas fa-plus mr-1"></i>Pertanyaan Baru';
      newQuesBtn.addEventListener('click', resetChatCompletely);

      wrapper.appendChild(researchBtn);
      wrapper.appendChild(newQuesBtn);
      chatBox.appendChild(wrapper);
      scrollToBottom();
    }

    // Reset ke categories (untuk riset/pertanyaan baru)
    function resetToCategories() {
      chatState.selectedCategory = null;
      chatState.selectedSubCategory = null;
      chatState.currentStep = 'categories';
      chatState.currentAnswer = null;

      const chatBox = document.getElementById('chatMessages');
      const subWrapper = document.getElementById('subCategoriesWrapper');
      const researchWrapper = document.getElementById('researchWrapper');
      
      if (subWrapper) subWrapper.remove();
      if (researchWrapper) researchWrapper.remove();

      // Add separator
      const separator = document.createElement('div');
      separator.className = 'border-t border-gray-300 my-3';
      chatBox.appendChild(separator);

      // Add new greeting
      const newGreeting = document.createElement('div');
      newGreeting.className = 'bg-white border border-gray-300 p-2 rounded-md text-xs';
      newGreeting.innerHTML = '<i class="fas fa-arrow-right text-gray-600 mr-2"></i><strong>Pilih kategori pertanyaan:</strong>';
      chatBox.appendChild(newGreeting);

      renderCategories();
    }

    // Reset chat completely (clear all messages dan kembali ke awal)
    function resetChatCompletely() {
      chatState = {
        currentStep: 'categories',
        selectedCategory: null,
        selectedSubCategory: null,
        categories: [],
        subCategories: [],
        currentAnswer: null
      };

      const chatBox = document.getElementById('chatMessages');
      chatBox.innerHTML = ''; // Bersihkan semua pesan

      // Add welcome message
      const botReply = document.createElement('div');
      botReply.id = 'welcomeMsg';
      botReply.className = 'bg-white border border-gray-300 p-3 rounded-md max-w-[85%] break-words shadow-sm';
      botReply.innerHTML = `
        <div class="flex items-start gap-2">
          <i class="fas fa-robot text-gray-600 mt-1"></i>
          <div>
            <p class="font-semibold text-gray-800 mb-1">Halo! 👋</p>
            <p class="text-gray-700 text-xs">Saya <strong>TechAI</strong>, asisten virtual dari Technology Multi System (TMS).</p>
            <p class="text-gray-600 text-xs mt-2">Silakan pilih kategori pertanyaan di bawah ini:</p>
          </div>
        </div>
      `;
      chatBox.appendChild(botReply);
      
      // Load dan render categories
      loadCategories();
      
      scrollToBottom();
    }

    // Auto show welcome message dan categories on load
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
              <p class="text-gray-700 text-xs">Saya <strong>TechAI</strong>, asisten virtual dari Technology Multi System (TMS).</p>
              <p class="text-gray-600 text-xs mt-2">Silakan pilih kategori pertanyaan di bawah ini:</p>
            </div>
          </div>
        `;
        msgContainer.insertBefore(botReply, msgContainer.firstChild);
        
        // Load dan render categories
        loadCategories();
        
        scrollToBottom();
      }
    });

    // Smooth scroll to bottom
    function scrollToBottom() {
      const chatBox = document.getElementById('chatMessages');
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    function sendMessage() {
      const input = document.getElementById('chatInput');
      const message = input.value.trim();
      
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
