<!--- Modal Chatbot Component with OpenAI Integration -->
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
      <!-- Greeting message will be added here -->
    </div>

    <!-- Input Area -->
    <form id="chatForm" class="px-4 py-3 border-t bg-gray-50 flex items-center space-x-2" onsubmit="event.preventDefault(); sendMessage();">
      <input id="chatInput" type="text" placeholder="Ketik pesan Anda..." maxlength="250"
        class="flex-grow max-w-[calc(100%-50px)] px-3 py-2 border border-gray-300 rounded-md text-sm bg-white text-gray-700 focus:outline-none focus:border-gray-500 transition" autocomplete="off" 
        title="Maksimal 250 karakter" />
      <button id="sendBtn" type="submit" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-md text-sm transition flex items-center justify-center" title="Kirim pesan">
        <span id="sendIcon">➤</span>
      </button>
    </form>
    
    <!-- Character Counter with Warning -->
    <div class="px-4 py-1 bg-gray-50 text-right flex justify-between items-center">
      <span id="charWarning" class="text-[10px] text-transparent">Mendekati batas karakter</span>
      <span id="charCounter" class="text-[10px] text-gray-400">0/250</span>
    </div>

    <!-- Footer -->
    <div class="text-center px-4 py-2 bg-gray-50 text-[10px] text-gray-500 select-none border-t">
      Powered by TechAI <a href="#" class="underline hover:text-gray-600">Privacy Policy</a>
    </div>
  </div>
  
  <script>
    // ============================================
    // CHATBOT SMART FEATURES
    // ============================================
    // ✅ Auto-Close Modal: 11 keywords
    // ✅ Empty Message Validation
    // ✅ Character Limit: 250 chars
    // ✅ Error Handling
    // ✅ Thinking Indicator
    // ============================================
    
    // Conversation history for context (last 10 messages)
    let conversationHistory = [];

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
      
      // Add initial greeting if no messages
      const chatMessages = document.getElementById('chatMessages');
      if (chatMessages.children.length === 0) {
        addBotMessage("Halo! 👋 Saya TechAI, asisten virtual Anda. Ada yang bisa saya bantu? Silakan tanyakan apa saja!");
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

    // Scroll to bottom
    function scrollToBottom() {
      const chatMessages = document.getElementById('chatMessages');
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Add user message to chat
    function addUserMessage(message) {
      const chatMessages = document.getElementById('chatMessages');
      const msgDiv = document.createElement('div');
      msgDiv.className = 'flex justify-end';
      msgDiv.innerHTML = `
        <div class="bg-gray-700 text-white px-4 py-2 rounded-lg max-w-[75%] shadow-sm">
          ${escapeHtml(message)}
        </div>
      `;
      chatMessages.appendChild(msgDiv);
      scrollToBottom();
    }

    // Add bot message to chat
    function addBotMessage(message) {
      const chatMessages = document.getElementById('chatMessages');
      const msgDiv = document.createElement('div');
      msgDiv.className = 'flex justify-start';
      msgDiv.innerHTML = `
        <div class="bg-white text-gray-800 px-4 py-2 rounded-lg max-w-[75%] shadow-sm border border-gray-200">
          ${escapeHtml(message)}
        </div>
      `;
      chatMessages.appendChild(msgDiv);
      scrollToBottom();
    }

    // Add thinking indicator
    function addThinkingIndicator() {
      const chatMessages = document.getElementById('chatMessages');
      const msgDiv = document.createElement('div');
      msgDiv.id = 'thinkingIndicator';
      msgDiv.className = 'flex justify-start';
      msgDiv.innerHTML = `
        <div class="bg-white text-gray-600 px-4 py-2 rounded-lg shadow-sm border border-gray-200">
          <span class="thinking-dots">TechAI sedang memproses</span>
        </div>
      `;
      chatMessages.appendChild(msgDiv);
      scrollToBottom();
    }

    // Remove thinking indicator
    function removeThinkingIndicator() {
      const indicator = document.getElementById('thinkingIndicator');
      if (indicator) {
        indicator.remove();
      }
    }

    // Escape HTML to prevent XSS
    function escapeHtml(text) {
      const div = document.createElement('div');
      div.textContent = text;
      return div.innerHTML;
    }

    // Check if message contains close keywords
    // 11 keywords untuk auto-close (TIDAK termasuk "makasih" dan "thanks")
    function shouldAutoClose(message) {
      const closeKeywords = [
        'close',      // "close aja"
        'tutup',      // "tutup ya"
        'keluar',     // "keluar dulu"
        'exit',       // "exit chat"
        'bye',        // "bye bye"
        'selesai',    // "udah selesai"
        'cukup',      // "udah cukup"
        'stop',       // "stop dulu"
        'sudah',      // "sudah ya"
        'oke cukup',  // "oke cukup deh"
        'udah ah'     // "udah ah close"
      ];
      const lowerMessage = message.toLowerCase().trim();
      
      // Check each keyword
      return closeKeywords.some(keyword => lowerMessage.includes(keyword));
    }

    // Send message to chatbot
    async function sendMessage() {
      const chatInput = document.getElementById('chatInput');
      const message = chatInput.value.trim();

      // ✅ SMART FEATURE 1: Empty Message Validation
      if (!message) {
        // Show warning modal
        document.getElementById('infoModal').classList.remove('hidden');
        document.getElementById('infoModal').style.display = 'flex';
        return;
      }

      // ✅ SMART FEATURE 2: Auto-Close Detection
      // Check if message contains close keywords (11 keywords)
      const shouldClose = shouldAutoClose(message);

      // Add user message to chat
      addUserMessage(message);
      chatInput.value = '';
      
      // Reset character counter
      document.getElementById('charCounter').textContent = '0/250';
      document.getElementById('charCounter').className = 'text-[10px] text-gray-400';

      // Add to conversation history
      conversationHistory.push({
        role: 'user',
        content: message
      });

      // Keep only last 10 messages
      if (conversationHistory.length > 20) {
        conversationHistory = conversationHistory.slice(-20);
      }

      // Disable send button and show loading
      const sendBtn = document.getElementById('sendBtn');
      const sendIcon = document.getElementById('sendIcon');
      sendBtn.disabled = true;
      sendIcon.innerHTML = '<svg class="animate-spin-btn w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" class="opacity-75"></path></svg>';

      // ✅ SMART FEATURE 3: Thinking Indicator
      addThinkingIndicator();

      try {
        // Send to API
        const response = await fetch('/api/chatbot/send', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            message: message,
            conversation_history: conversationHistory
          })
        });

        const data = await response.json();

        // Remove thinking indicator
        removeThinkingIndicator();

        if (data.success) {
          // Add bot response
          addBotMessage(data.message);

          // Add to conversation history
          conversationHistory.push({
            role: 'assistant',
            content: data.message
          });

          // ✅ SMART FEATURE 4: Auto-Close Modal
          // Close modal 3 seconds after AI responds if close keyword detected
          if (shouldClose) {
            setTimeout(() => {
              closeChatModal();
            }, 3000); // 3 detik
          }
        } else {
          // ✅ SMART FEATURE 5: Error Handling
          addBotMessage('Maaf, terjadi kesalahan. Silakan coba lagi. ❌');
        }

      } catch (error) {
        removeThinkingIndicator();
        // ✅ SMART FEATURE 5: User-Friendly Error Message
        addBotMessage('Maaf, koneksi bermasalah. Pastikan Anda terhubung ke internet. 🔌');
        console.error('Chatbot error:', error);
      }

      // Re-enable send button
      sendBtn.disabled = false;
      sendIcon.innerHTML = '➤';
      chatInput.focus();
    }

    // Allow Enter key to send message
    document.addEventListener('DOMContentLoaded', function() {
      const chatInput = document.getElementById('chatInput');
      const charCounter = document.getElementById('charCounter');
      const charWarning = document.getElementById('charWarning');
      
      if (chatInput) {
        // Enter key handler
        chatInput.addEventListener('keypress', function(e) {
          if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
          }
        });
        
        // ✅ SMART FEATURE: Character Counter with Color Indicator
        chatInput.addEventListener('input', function() {
          const currentLength = this.value.length;
          const maxLength = 250;
          charCounter.textContent = `${currentLength}/${maxLength}`;
          
          // Change color and show warning when approaching limit
          if (currentLength > 200) {
            // RED: Very close to limit (200-250)
            charCounter.classList.add('text-red-500', 'font-semibold');
            charCounter.classList.remove('text-gray-400', 'text-yellow-600');
            charWarning.classList.remove('text-transparent');
            charWarning.classList.add('text-red-500');
            charWarning.textContent = '⚠️ Mendekati batas!';
          } else if (currentLength > 150) {
            // YELLOW: Getting close (150-200)
            charCounter.classList.add('text-yellow-600', 'font-semibold');
            charCounter.classList.remove('text-gray-400', 'text-red-500');
            charWarning.classList.remove('text-transparent');
            charWarning.classList.add('text-yellow-600');
            charWarning.textContent = 'Mendekati batas karakter';
          } else {
            // GRAY: Normal (0-150)
            charCounter.classList.add('text-gray-400');
            charCounter.classList.remove('text-yellow-600', 'text-red-500', 'font-semibold');
            charWarning.classList.add('text-transparent');
            charWarning.classList.remove('text-yellow-600', 'text-red-500');
          }
        });
      }
    });
  </script>
