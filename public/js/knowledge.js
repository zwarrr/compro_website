// TechAI Knowledge Base

const knowledgeBase = {
  // Greeting & Intro
  greetings: {
    keywords: ["halo", "hi", "assalamu'alaikum", "hallo", "pagi", "siang", "sore", "malam", "hello", "hey", "good morning", "good afternoon", "good evening", "apa kabar", "bagaimana kabar", "how are you", "kabar"],
    responseId: "greetings",
    responseBahasa: {
      id: "Halo! Ada yang bisa saya bantu hari ini?",
      en: "Hi! How can I help you today?"
    }
  },

  // TechAI Information
  techai: {
    keywords: ["what is techai", "apa itu techai", "siapa techai", "who is techai", "tentang techai", "about techai", "profil techai", "kemampuan techai", "fitur techai"],
    responseId: "techai",
    responseBahasa: {
      id: "TechAI adalah asisten virtual cerdas berbasis AI dari Technology Multi Sistem (TMS). Saya dirancang khusus untuk:\n\n- Memberikan informasi lengkap tentang TMS dan layanan kami\n- Menjawab pertanyaan umum seputar teknologi dan solusi digital\n- Memberikan rekomendasi solusi yang sesuai dengan kebutuhan Anda\n- Memandu Anda ke departemen atau tim yang tepat\n- Memberikan dukungan FAQ dan troubleshooting dasar\n- Membantu 24/7 dalam bahasa Indonesia dan Inggris\n\nSaya siap membantu Anda menjelajahi ekosistem digital TMS dan menemukan solusi terbaik untuk bisnis Anda. Ada yang ingin ditanyakan?",
      en: "TechAI is an intelligent AI-powered virtual assistant from Technology Multi Sistem (TMS). I'm specifically designed to:\n\n- Provide complete information about TMS and our services\n- Answer general questions about technology and digital solutions\n- Provide solution recommendations tailored to your needs\n- Guide you to the right department or team\n- Provide FAQ support and basic troubleshooting\n- Help you 24/7 in Indonesian and English\n\nI'm ready to help you explore TMS's digital ecosystem and find the best solutions for your business. What would you like to ask?"
    }
  },

  // TMS Information
  tms: {
    keywords: ["apa itu tms", "what is tms", "tentang tms", "about tms", "siapa tms", "who is tms", "perusahaan tms", "company tms", "technology multi sistem", "profil", "profile", "informasi tms"],
    responseId: "tms",
    responseBahasa: {
      id: "Technology Multi Sistem (TMS) adalah perusahaan teknologi terkemuka yang didirikan pada tahun 2005 dan berpengalaman lebih dari 15 tahun dalam memberikan solusi teknologi terintegrasi untuk bisnis modern.\n\nKami spesialis dalam:\n- Konsultasi IT dan perencanaan strategi digital\n- Pengembangan software custom sesuai kebutuhan bisnis\n- Implementasi cloud infrastructure yang aman dan scalable\n- Solusi cybersecurity untuk perlindungan data\n- Layanan transformasi digital menyeluruh\n- Support dan maintenance sistem\n\nTim profesional kami siap membantu bisnis Anda berkembang dengan teknologi terkini. Apakah ada aspek tertentu dari TMS yang ingin Anda ketahui lebih lanjut?",
      en: "Technology Multi Sistem (TMS) is a leading technology company founded in 2005 with over 15 years of experience in providing integrated technology solutions for modern businesses.\n\nWe specialize in:\n- IT consulting and digital strategy planning\n- Custom software development tailored to your business needs\n- Implementation of secure and scalable cloud infrastructure\n- Cybersecurity solutions for data protection\n- Complete digital transformation services\n- System support and maintenance\n\nOur professional team is ready to help your business grow with the latest technology. Is there any specific aspect of TMS you'd like to know more about?"
    }
  },

  // Services
  services: {
    keywords: ["layanan", "services", "apa layanan", "produk", "products", "penawaran", "offerings", "apa saja", "what services", "kami sediakan", "menyediakan"],
    responseId: "services",
    responseBahasa: {
      id: "TMS menyediakan berbagai layanan lengkap untuk kebutuhan digital bisnis Anda:\n\n1. Konsultasi IT & Strategy - Kami membantu merancang strategi teknologi yang tepat untuk bisnis Anda\n2. Pengembangan Software Custom - Solusi software yang disesuaikan dengan kebutuhan spesifik perusahaan Anda\n3. Cloud Infrastructure - Infrastruktur cloud yang aman, scalable, dan reliable\n4. Cybersecurity Solutions - Perlindungan keamanan data dan sistem yang komprehensif\n5. Digital Transformation - Transformasi digital menyeluruh untuk modernisasi bisnis Anda\n6. Support & Maintenance - Tim support profesional untuk memastikan sistem Anda selalu berjalan optimal\n\nUntuk informasi lebih detail tentang layanan tertentu, silakan tanyakan atau hubungi tim kami.",
      en: "TMS provides comprehensive services for all your digital business needs:\n\n1. IT Consulting & Strategy - We help design the right technology strategy for your business\n2. Custom Software Development - Software solutions tailored to your company's specific needs\n3. Cloud Infrastructure - Secure, scalable, and reliable cloud infrastructure\n4. Cybersecurity Solutions - Comprehensive data and system security protection\n5. Digital Transformation - Complete digital transformation for business modernization\n6. Support & Maintenance - Professional support team to ensure your systems run optimally\n\nFor more details about specific services, feel free to ask or contact our team."
    }
  },

  // Contact
  contact: {
    keywords: ["hubungi", "hubung", "kontak", "contact", "nomor", "phone", "email", "alamat", "address", "telepon", "reach us", "menghubungi", "dihubungi", "whatsapp", "wa", "information", "informasi"],
    responseId: "contact",
    responseBahasa: {
      id: "Hubungi kami melalui:\n\nTelepon: 085223035426\nEmail: kocicenter@gmail.com\nAlamat: JL. Ciamis-Banjar Dusun Kidul RT/RW 007/003 Cijeungjing, Ciamis\n\nJam kerja: Senin-Jumat 09:00-17:00 WIB\n\nAnda bisa menghubungi kami melalui telepon, email, atau WhatsApp untuk pertanyaan lebih lanjut. Tim kami siap membantu Anda!",
      en: "Contact us through:\n\nPhone: 085223035426\nEmail: kocicenter@gmail.com\nOffice: JL. Ciamis-Banjar Dusun Kidul RT/RW 007/003 Cijeungjing, Ciamis\n\nBusiness Hours: Monday-Friday 09:00 AM - 5:00 PM WIB\n\nYou can reach us via phone, email, or WhatsApp for further inquiries. Our team is ready to help you!"
    }
  },

  // Help
  help: {
    keywords: ["bantuan", "help", "tulong", "assist", "bisa apa", "what can you do", "kemampuan", "can you", "apa yang bisa", "fitur", "feature", "apa saja"],
    responseId: "help",
    responseBahasa: {
      id: "Berikut adalah kemampuan dan layanan yang dapat saya berikan:\n\n1. Informasi Lengkap - Tentang TMS, layanan kami, dan solusi digital\n2. Menjawab Pertanyaan - Pertanyaan umum seputar bisnis dan teknologi\n3. Rekomendasi Solusi - Solusi yang tepat sesuai kebutuhan bisnis Anda\n4. Pengarahan Tim - Mengarahkan Anda ke tim atau departemen yang tepat\n5. FAQ & Troubleshooting - Pertanyaan umum dan solusi masalah dasar\n6. Bilingual Support - Dukungan dalam bahasa Indonesia dan Inggris\n7. Kontak & Informasi - Data kontak, alamat, jam operasional TMS\n\nSaya siap membantu Anda 24/7. Silakan ajukan pertanyaan atau ceritakan kebutuhan Anda!",
      en: "Here are the capabilities and services I can provide:\n\n1. Complete Information - About TMS, our services, and digital solutions\n2. Answer Questions - General questions about business and technology\n3. Solution Recommendations - Solutions tailored to your business needs\n4. Team Direction - Direct you to the right team or department\n5. FAQ & Troubleshooting - Common questions and basic problem solutions\n6. Bilingual Support - Support in Indonesian and English\n7. Contact & Information - Contact details, office address, operating hours\n\nI'm ready to help you 24/7. Feel free to ask questions or tell me your needs!"
    }
  },

  // Solutions
  solutions: {
    keywords: ["solusi", "solution", "masalah", "problem", "issue", "bantuan teknis", "technical help", "support", "error", "troubleshoot", "tidak berfungsi", "broken", "not working"],
    responseId: "solutions",
    responseBahasa: {
      id: "Kami siap membantu Anda mengatasi berbagai masalah teknis. Untuk memberikan solusi terbaik, bisa Anda jelaskan lebih detail masalah yang sedang dihadapi?\n\nMasalah bisa terkait dengan:\n\n1. Software & Aplikasi - Error aplikasi, bug, atau fitur yang tidak berfungsi\n2. Infrastruktur IT - Server, jaringan, atau hardware yang bermasalah\n3. Keamanan Data - Masalah keamanan, backup, atau compliance\n4. Cloud Services - Masalah dengan cloud storage atau cloud infrastructure\n5. Integrasi Sistem - Masalah integrasi antar sistem atau API\n6. Lainnya - Masalah teknis lainnya yang belum disebutkan\n\nBerikan detail masalahnya agar tim kami dapat memberikan solusi yang tepat. Anda juga bisa menghubungi tim support kami secara langsung di 085223035426.",
      en: "We're ready to help resolve various technical issues. To provide the best solution, could you describe the problem you're facing in more detail?\n\nThe issue could be related to:\n\n1. Software & Applications - Application errors, bugs, or non-functioning features\n2. IT Infrastructure - Server, network, or hardware problems\n3. Data Security - Security issues, backup, or compliance concerns\n4. Cloud Services - Issues with cloud storage or cloud infrastructure\n5. System Integration - Integration or API problems between systems\n6. Others - Other technical issues not mentioned above\n\nProvide details about your problem so our team can provide the right solution. You can also contact our support team directly at 085223035426."
    }
  },

  // Pricing & Packages
  pricing: {
    keywords: ["harga", "price", "paket", "package", "biaya", "cost", "tarif", "rate", "pricing", "berapa", "how much", "investasi", "investment"],
    responseId: "pricing",
    responseBahasa: {
      id: "Paket layanan TMS dirancang khusus dan disesuaikan dengan kebutuhan dan skala bisnis Anda:\n\n1. Paket Starter - Untuk UKM dan startup\n   - Ideal untuk bisnis yang baru memulai transformasi digital\n   - Mencakup konsultasi dasar, support, dan maintenance\n\n2. Paket Professional - Untuk Perusahaan Menengah\n   - Mencakup pengembangan software custom, cloud setup, dan support 24/7\n   - Solusi lengkap untuk pertumbuhan bisnis\n\n3. Paket Enterprise - Untuk Korporasi Besar\n   - Solusi komprehensif dengan cybersecurity, cloud infrastructure, dan support premium\n   - Tim dedicated untuk kebutuhan spesifik Anda\n\nSetiap paket dapat dikustomisasi sesuai kebutuhan. Untuk penawaran khusus dan konsultasi gratis, silakan hubungi tim sales kami di 085223035426 atau kocicenter@gmail.com",
      en: "TMS service packages are specially designed and tailored to your business needs and scale:\n\n1. Starter Package - For SMEs and startups\n   - Ideal for businesses beginning their digital transformation\n   - Includes basic consulting, support, and maintenance\n\n2. Professional Package - For Medium Enterprises\n   - Includes custom software development, cloud setup, and 24/7 support\n   - Complete solutions for business growth\n\n3. Enterprise Package - For Large Corporations\n   - Comprehensive solutions with cybersecurity, cloud infrastructure, and premium support\n   - Dedicated team for your specific needs\n\nEach package can be customized according to your requirements. For special offers and free consultation, please contact our sales team at 085223035426 or kocicenter@gmail.com"
    }
  },

  // Default responses
  default: {
    id: [
      "Terima kasih atas pertanyaannya! Saya akan membantu sebaik mungkin.",
      "Menarik pertanyaannya. Bisa Anda jelaskan lebih detail?",
      "Saya sedang belajar lebih banyak tentang topik ini. Silakan hubungi tim kami untuk informasi lebih akurat.",
      "Apakah pertanyaan Anda terkait dengan layanan TMS?",
      "Saya di sini untuk membantu. Ada yang bisa saya jelaskan?"
    ],
    en: [
      "Thank you for your question! I'll help you as best I can.",
      "Interesting question. Could you explain it in more detail?",
      "I'm learning more about this topic. Please contact our team for more accurate information.",
      "Is your question related to TMS services?",
      "I'm here to help. Is there anything I can explain?"
    ]
  }
};

// Function untuk detect bahasa
function detectLanguage(message) {
  const lowerMessage = message.toLowerCase();
  
  // Deteksi perintah untuk gunakan bahasa Inggris
  const englishCommands = [
    "gunakan bahasa inggris", "gunakan english", "pakai bahasa inggris", 
    "pakai english", "use english", "use english language", "english please",
    "inggris", "dalam inggris", "in english", "speak english", "reply in english",
    "respond in english", "jawab dalam inggris", "ubah ke inggris", "berubah ke inggris",
    "ganti bahasa inggris", "switch to english"
  ];
  
  // Deteksi perintah untuk gunakan bahasa Indonesia
  const indonesianCommands = [
    "gunakan bahasa indo", "gunakan bahasa indonesia", "gunakan indonesia",
    "pakai bahasa indo", "pakai bahasa indonesia", "pakai indonesia",
    "use indonesian", "use indonesia language", "indonesian please",
    "indo", "indonesia", "dalam indo", "dalam indonesia", "in indonesian",
    "speak indonesian", "reply in indonesian", "respond in indonesian",
    "jawab dalam indo", "ubah ke indo", "berubah ke indo", "ganti bahasa indo",
    "switch to indonesian", "gunakan nggris"
  ];
  
  // Cek perintah bahasa Inggris terlebih dahulu
  for (let command of englishCommands) {
    if (lowerMessage.includes(command)) {
      return 'en';
    }
  }
  
  // Cek perintah bahasa Indonesia
  for (let command of indonesianCommands) {
    if (lowerMessage.includes(command)) {
      return 'id';
    }
  }
  
  // Indonesian keywords yang lebih komprehensif
  const indonesianKeywords = [
    "apa", "yang", "adalah", "saya", "anda", "dengan", "untuk", "dari", "ke", "di", 
    "ini", "itu", "jika", "bagaimana", "berapa", "siapa", "halo", "hallo", "pagi", 
    "siang", "sore", "malam", "hubungi", "hubung", "kontak", "nomor", "alamat", 
    "telepon", "menghubungi", "dihubungi", "layanan", "produk", "penawaran",
    "bantuan", "tulong", "assist", "bisa", "kemampuan", "solusi", "masalah", 
    "harga", "paket", "biaya", "tarif", "teknologi", "sistem", "multi"
  ];
  
  // English keywords
  const englishKeywords = [
    "what", "is", "are", "where", "when", "how", "why", "can", "could", "would", 
    "should", "help", "contact", "phone", "email", "address", "service", "product",
    "price", "package", "solution", "problem", "issue", "support", "hello", "hi", "the", "a"
  ];
  
  // Hitung Indonesian keywords
  let indonesianCount = 0;
  for (let keyword of indonesianKeywords) {
    if (lowerMessage.includes(keyword)) {
      indonesianCount++;
    }
  }
  
  // Hitung English keywords
  let englishCount = 0;
  for (let keyword of englishKeywords) {
    if (lowerMessage.includes(keyword)) {
      englishCount++;
    }
  }
  
  // Jika Indonesian keywords lebih banyak, gunakan Indonesian
  if (indonesianCount > englishCount) {
    return 'id';
  }
  // Jika English keywords lebih banyak, gunakan English
  if (englishCount > indonesianCount) {
    return 'en';
  }
  
  // Jika sama, cek apakah ada huruf Latin (English), kalau tidak default ke Indonesian
  const englishChars = /[a-zA-Z]/g;
  const hasEnglish = (message.match(englishChars) || []).length > 5;
  
  return hasEnglish ? 'en' : 'id';
}

// Function untuk generate AI Response
function generateAIResponse(message) {
  const lowerMessage = message.toLowerCase().trim();
  const language = detectLanguage(message);

  // Fungsi helper untuk matching keyword yang lebih flexible
  function checkKeywords(keywords, text) {
    for (let keyword of keywords) {
      const keywordLower = keyword.toLowerCase();
      // Match jika ada kata/phrase yang sama, tidak peduli case
      if (text.includes(keywordLower)) {
        return true;
      }
      // Juga cek word boundaries untuk matching yang lebih akurat
      const wordRegex = new RegExp('\\b' + keywordLower.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '\\b', 'gi');
      if (wordRegex.test(text)) {
        return true;
      }
    }
    return false;
  }

  // Check Greetings - prioritas pertama (jika hanya greeting saja tanpa topik lain)
  if (checkKeywords(knowledgeBase.greetings.keywords, lowerMessage)) {
    // Cek apakah ada topik lain dalam pesan
    const hasOtherTopics = checkKeywords(knowledgeBase.services.keywords, lowerMessage) ||
                          checkKeywords(knowledgeBase.contact.keywords, lowerMessage) ||
                          checkKeywords(knowledgeBase.pricing.keywords, lowerMessage) ||
                          checkKeywords(knowledgeBase.tms.keywords, lowerMessage) ||
                          checkKeywords(knowledgeBase.solutions.keywords, lowerMessage);
    
    // Jika hanya greeting, kembalikan greeting response
    if (!hasOtherTopics) {
      return knowledgeBase.greetings.responseBahasa[language];
    }
  }

  // Check TechAI info
  if (checkKeywords(knowledgeBase.techai.keywords, lowerMessage)) {
    return knowledgeBase.techai.responseBahasa[language];
  }

  // Check TMS info
  if (checkKeywords(knowledgeBase.tms.keywords, lowerMessage)) {
    return knowledgeBase.tms.responseBahasa[language];
  }

  // Check Contact
  if (checkKeywords(knowledgeBase.contact.keywords, lowerMessage)) {
    return knowledgeBase.contact.responseBahasa[language];
  }

  // Check Services
  if (checkKeywords(knowledgeBase.services.keywords, lowerMessage)) {
    return knowledgeBase.services.responseBahasa[language];
  }

  // Check Help
  if (checkKeywords(knowledgeBase.help.keywords, lowerMessage)) {
    return knowledgeBase.help.responseBahasa[language];
  }

  // Check Solutions
  if (checkKeywords(knowledgeBase.solutions.keywords, lowerMessage)) {
    return knowledgeBase.solutions.responseBahasa[language];
  }

  // Check Pricing
  if (checkKeywords(knowledgeBase.pricing.keywords, lowerMessage)) {
    return knowledgeBase.pricing.responseBahasa[language];
  }

  // Return random default response
  const defaultResponses = knowledgeBase.default[language];
  return defaultResponses[Math.floor(Math.random() * defaultResponses.length)];
}

console.log('✅ TechAI Knowledge Base loaded successfully with bilingual support');
