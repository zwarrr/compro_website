// TechAI Knowledge Base - Bahasa Indonesia

const knowledgeBase = {
  // Sapaan & Perkenalan
  greetings: {
    keywords: ["halo", "hai", "assalamu'alaikum", "hallo", "pagi", "siang", "sore", "malam", "apa kabar", "bagaimana kabar", "kabar"],
    response: "Halo! Ada yang bisa saya bantu hari ini?"
  },

  // Informasi TechAI
  techai: {
    keywords: ["apa itu techai", "siapa techai", "tentang techai", "profil techai", "kemampuan techai", "fitur techai"],
    response: "TechAI adalah asisten virtual cerdas berbasis AI dari Technology Multi Sistem (TMS). Saya dirancang khusus untuk:\n\n- Memberikan informasi lengkap tentang TMS dan layanan kami\n- Menjawab pertanyaan umum seputar teknologi dan solusi digital\n- Memberikan rekomendasi solusi yang sesuai dengan kebutuhan Anda\n- Memandu Anda ke departemen atau tim yang tepat\n- Memberikan dukungan FAQ dan troubleshooting dasar\n- Membantu 24/7 dalam bahasa Indonesia\n\nSaya siap membantu Anda menjelajahi ekosistem digital TMS dan menemukan solusi terbaik untuk bisnis Anda. Ada yang ingin ditanyakan?"
  },

  // Informasi TMS
  tms: {
    keywords: ["apa itu tms", "tentang tms", "siapa tms", "perusahaan tms", "technology multi sistem", "profil", "informasi tms"],
    response: "Technology Multi Sistem (TMS) adalah perusahaan teknologi terkemuka yang didirikan pada tahun 2005 dan berpengalaman lebih dari 15 tahun dalam memberikan solusi teknologi terintegrasi untuk bisnis modern.\n\nKami spesialis dalam:\n- Konsultasi IT dan perencanaan strategi digital\n- Pengembangan software custom sesuai kebutuhan bisnis\n- Implementasi cloud infrastructure yang aman dan scalable\n- Solusi cybersecurity untuk perlindungan data\n- Layanan transformasi digital menyeluruh\n- Support dan maintenance sistem\n\nTim profesional kami siap membantu bisnis Anda berkembang dengan teknologi terkini. Apakah ada aspek tertentu dari TMS yang ingin Anda ketahui lebih lanjut?"
  },

  // Layanan
  services: {
    keywords: ["layanan", "apa layanan", "produk", "penawaran", "apa saja", "kami sediakan", "menyediakan"],
    response: "TMS menyediakan berbagai layanan lengkap untuk kebutuhan digital bisnis Anda:\n\n1. Konsultasi IT & Strategy - Kami membantu merancang strategi teknologi yang tepat untuk bisnis Anda\n2. Pengembangan Software Custom - Solusi software yang disesuaikan dengan kebutuhan spesifik perusahaan Anda\n3. Cloud Infrastructure - Infrastruktur cloud yang aman, scalable, dan reliable\n4. Cybersecurity Solutions - Perlindungan keamanan data dan sistem yang komprehensif\n5. Digital Transformation - Transformasi digital menyeluruh untuk modernisasi bisnis Anda\n6. Support & Maintenance - Tim support profesional untuk memastikan sistem Anda selalu berjalan optimal\n\nUntuk informasi lebih detail tentang layanan tertentu, silakan tanyakan atau hubungi tim kami."
  },

  // Kontak
  contact: {
    keywords: ["hubungi", "hubung", "kontak", "nomor", "email", "alamat", "telepon", "menghubungi", "dihubungi", "whatsapp", "wa", "informasi"],
    response: "Hubungi kami melalui:\n\n📞 Telepon: 085223035426\n📧 Email: kocicenter@gmail.com\n📍 Alamat: JL. Ciamis-Banjar Dusun Kidul RT/RW 007/003 Cijeungjing, Ciamis\n\nJam kerja: Senin-Jumat 09:00-17:00 WIB\n\nAnda bisa menghubungi kami melalui telepon, email, atau WhatsApp untuk pertanyaan lebih lanjut. Tim kami siap membantu Anda!"
  },

  // Bantuan
  help: {
    keywords: ["bantuan", "tolong", "bisa apa", "kemampuan", "apa yang bisa", "fitur", "apa saja"],
    response: "Berikut adalah kemampuan dan layanan yang dapat saya berikan:\n\n1. Informasi Lengkap - Tentang TMS, layanan kami, dan solusi digital\n2. Menjawab Pertanyaan - Pertanyaan umum seputar bisnis dan teknologi\n3. Rekomendasi Solusi - Solusi yang tepat sesuai kebutuhan bisnis Anda\n4. Pengarahan Tim - Mengarahkan Anda ke tim atau departemen yang tepat\n5. FAQ & Troubleshooting - Pertanyaan umum dan solusi masalah dasar\n6. Kontak & Informasi - Data kontak, alamat, jam operasional TMS\n\nSaya siap membantu Anda 24/7. Silakan ajukan pertanyaan atau ceritakan kebutuhan Anda!"
  },

  // Solusi
  solutions: {
    keywords: ["solusi", "masalah", "bantuan teknis", "support", "error", "troubleshoot", "tidak berfungsi"],
    response: "Kami siap membantu Anda mengatasi berbagai masalah teknis. Untuk memberikan solusi terbaik, bisa Anda jelaskan lebih detail masalah yang sedang dihadapi?\n\nMasalah bisa terkait dengan:\n\n1. Software & Aplikasi - Error aplikasi, bug, atau fitur yang tidak berfungsi\n2. Infrastruktur IT - Server, jaringan, atau hardware yang bermasalah\n3. Keamanan Data - Masalah keamanan, backup, atau compliance\n4. Cloud Services - Masalah dengan cloud storage atau cloud infrastructure\n5. Integrasi Sistem - Masalah integrasi antar sistem atau API\n6. Lainnya - Masalah teknis lainnya yang belum disebutkan\n\nBerikan detail masalahnya agar tim kami dapat memberikan solusi yang tepat. Anda juga bisa menghubungi tim support kami secara langsung di 085223035426."
  },

  // Harga & Paket
  pricing: {
    keywords: ["harga", "paket", "biaya", "tarif", "berapa", "investasi"],
    response: "Paket layanan TMS dirancang khusus dan disesuaikan dengan kebutuhan dan skala bisnis Anda:\n\n1. Paket Starter - Untuk UKM dan startup\n   - Ideal untuk bisnis yang baru memulai transformasi digital\n   - Mencakup konsultasi dasar, support, dan maintenance\n\n2. Paket Professional - Untuk Perusahaan Menengah\n   - Mencakup pengembangan software custom, cloud setup, dan support 24/7\n   - Solusi lengkap untuk pertumbuhan bisnis\n\n3. Paket Enterprise - Untuk Korporasi Besar\n   - Solusi komprehensif dengan cybersecurity, cloud infrastructure, dan support premium\n   - Tim dedicated untuk kebutuhan spesifik Anda\n\nSetiap paket dapat dikustomisasi sesuai kebutuhan. Untuk penawaran khusus dan konsultasi gratis, silakan hubungi tim sales kami di 085223035426 atau kocicenter@gmail.com"
  },

  // Respon default
  default: "Hubungi kami melalui:\n\n📞 Telepon: 085223035426\n📧 Email: kocicenter@gmail.com\n\nuntuk informasi lebih lanjut"
};

// Function untuk generate AI Response
function generateAIResponse(message) {
  const lowerMessage = message.toLowerCase().trim();

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
      return knowledgeBase.greetings.response;
    }
  }

  // Check TechAI info
  if (checkKeywords(knowledgeBase.techai.keywords, lowerMessage)) {
    return knowledgeBase.techai.response;
  }

  // Check TMS info
  if (checkKeywords(knowledgeBase.tms.keywords, lowerMessage)) {
    return knowledgeBase.tms.response;
  }

  // Check Contact
  if (checkKeywords(knowledgeBase.contact.keywords, lowerMessage)) {
    return knowledgeBase.contact.response;
  }

  // Check Services
  if (checkKeywords(knowledgeBase.services.keywords, lowerMessage)) {
    return knowledgeBase.services.response;
  }

  // Check Help
  if (checkKeywords(knowledgeBase.help.keywords, lowerMessage)) {
    return knowledgeBase.help.response;
  }

  // Check Solutions
  if (checkKeywords(knowledgeBase.solutions.keywords, lowerMessage)) {
    return knowledgeBase.solutions.response;
  }

  // Check Pricing
  if (checkKeywords(knowledgeBase.pricing.keywords, lowerMessage)) {
    return knowledgeBase.pricing.response;
  }

  // Return default response
  return knowledgeBase.default;
}

console.log('✅ Basis pengetahuan TechAI berhasil dimuat (Bahasa Indonesia)');
