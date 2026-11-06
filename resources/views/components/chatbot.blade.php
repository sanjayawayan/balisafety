<!-- Google Gemini AI Safety Chatbot Component (Token-Efficient Version) -->
<div id="chatbotWrapper" class="fixed z-50 transition-all duration-300">

    <!-- Floating Chat Trigger Button (Desktop / Tablet) -->
    <div id="chatTriggerBtn" class="fixed bottom-6 right-6 z-40 hidden md:block">
        <button onclick="toggleChatbot()" class="group relative flex items-center space-x-3 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white p-3.5 sm:px-5 sm:py-3.5 rounded-full shadow-2xl border-2 border-amber-500/80 hover:border-amber-400 hover:scale-105 active:scale-95 transition-all">
            <div class="relative flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-tr from-amber-500 to-amber-300 text-slate-950 font-bold shadow">
                <i class="fa-solid fa-sparkles text-sm animate-pulse"></i>
                <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-500 border border-slate-950 rounded-full"></span>
            </div>
            <div class="text-left hidden sm:block pr-1">
                <p class="text-[11px] font-bold text-amber-400 uppercase tracking-wider flex items-center">
                    <span>Chatbot AI</span>
                    <span class="ml-1.5 px-1.5 py-0.2 rounded bg-amber-500/20 text-amber-300 text-[9px]">Gemini</span>
                </p>
                <p class="text-xs font-semibold text-slate-200">Tanya Keamanan Bali</p>
            </div>
        </button>
    </div>

    <!-- Chatbot Window / Drawer (Responsive for Mobile & Desktop) -->
    <div id="chatDrawer" class="fixed inset-0 sm:inset-auto sm:bottom-6 sm:right-6 sm:w-[420px] sm:max-h-[640px] z-50 hidden flex-col bg-white sm:rounded-2xl shadow-2xl border border-slate-200/80 overflow-hidden sm:border-slate-300">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white px-4 py-3.5 flex items-center justify-between border-b border-slate-800 shadow-sm">
            <div class="flex items-center space-x-3">
                <div class="relative w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-amber-300 p-0.5 shadow">
                    <div class="w-full h-full bg-slate-950 rounded-[10px] flex items-center justify-center text-amber-400">
                        <i class="fa-solid fa-robot text-lg"></i>
                    </div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500 border-2 border-slate-900 rounded-full"></span>
                </div>
                <div>
                    <div class="flex items-center space-x-2">
                        <h4 class="font-bold text-sm tracking-wide text-white">BaliGuard AI</h4>
                        <span class="text-[10px] font-extrabold bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-1.5 py-0.5 rounded shadow-sm">
                            <i class="fa-solid fa-sparkles mr-1"></i>Gemini
                        </span>
                    </div>
                    <div class="flex items-center space-x-1.5 mt-0.5">
                        <span class="text-[10px] text-emerald-400 font-semibold flex items-center">
                            <i class="fa-solid fa-bolt mr-1"></i>Hemat Token Aktif
                        </span>
                        <span class="text-slate-500 text-[10px]">&bull;</span>
                        <span class="text-[10px] text-slate-400">Max 250 Tok</span>
                    </div>
                </div>
            </div>

            <!-- Header Action Buttons -->
            <div class="flex items-center space-x-1">
                <button type="button" onclick="clearChatHistory()" title="Bersihkan Percakapan" class="p-2 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition text-xs">
                    <i class="fa-solid fa-rotate-left"></i>
                </button>
                <button type="button" onclick="toggleChatbot(false)" class="p-2 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition text-base">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        <!-- Chat Notification Banner (Token Saver Indicator) -->
        <div class="bg-emerald-50/90 border-b border-emerald-200 px-3.5 py-1.5 text-[11px] text-emerald-900 flex items-center justify-between">
            <span class="flex items-center truncate">
                <i class="fa-solid fa-shield-halved text-emerald-600 mr-1.5"></i>
                <span>Respon ringkas & cepat (hemat input/output token)</span>
            </span>
            <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100 px-1.5 py-0.5 rounded">
                ⚡ 250 Tok
            </span>
        </div>

        <!-- Messages Scrollable Body -->
        <div id="chatMessages" class="flex-1 overflow-y-auto p-4 space-y-4 bg-slate-50/70 text-xs sm:text-sm">
            
            <!-- Welcome AI Bubble -->
            <div class="flex items-start space-x-2.5">
                <div class="w-8 h-8 rounded-full bg-slate-900 text-amber-400 flex items-center justify-center flex-shrink-0 shadow-sm border border-slate-700">
                    <i class="fa-solid fa-shield-halved text-xs"></i>
                </div>
                <div class="flex-1">
                    <div class="bg-white border border-slate-200 p-3.5 rounded-2xl rounded-tl-none shadow-sm text-slate-800 space-y-2">
                        <p class="font-semibold text-slate-900 text-xs">Om Swastyastu! 🙏</p>
                        <p class="leading-relaxed text-xs">
                            Saya <strong>BaliGuard AI</strong> yang didukung Google Gemini. Butuh bantuan cepat kantor polisi, nomor ambulans, RS rujukan, atau aturan adat di Bali?
                        </p>
                    </div>
                    <span class="text-[10px] text-slate-400 mt-1 block">BaliGuard AI &bull; Mode Hemat Token</span>
                </div>
            </div>

            <!-- Quick Suggestion Chips -->
            <div id="quickChipsContainer" class="pt-1 space-y-1.5">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pertanyaan Cepat:</p>
                <div class="flex flex-wrap gap-1.5">
                    <button type="button" onclick="sendQuickPrompt('Nomor darurat polisi di Kuta & Seminyak?')" class="text-[11px] font-medium bg-white hover:bg-amber-50 hover:text-amber-700 hover:border-amber-300 border border-slate-200 text-slate-700 px-2.5 py-1.5 rounded-lg shadow-sm transition">
                        🚨 Polisi Kuta
                    </button>
                    <button type="button" onclick="sendQuickPrompt('RS terdekat & vaksin rabies di Ubud?')" class="text-[11px] font-medium bg-white hover:bg-amber-50 hover:text-amber-700 hover:border-amber-300 border border-slate-200 text-slate-700 px-2.5 py-1.5 rounded-lg shadow-sm transition">
                        🏥 RS & Rabies Ubud
                    </button>
                    <button type="button" onclick="sendQuickPrompt('Aturan sewa motor dan tilang turis di Bali?')" class="text-[11px] font-medium bg-white hover:bg-amber-50 hover:text-amber-700 hover:border-amber-300 border border-slate-200 text-slate-700 px-2.5 py-1.5 rounded-lg shadow-sm transition">
                        🛵 Sewa Motor & Helm
                    </button>
                    <button type="button" onclick="sendQuickPrompt('Etika pakaian saat berkunjung ke Pura?')" class="text-[11px] font-medium bg-white hover:bg-amber-50 hover:text-amber-700 hover:border-amber-300 border border-slate-200 text-slate-700 px-2.5 py-1.5 rounded-lg shadow-sm transition">
                        🛕 Etika Pura
                    </button>
                    <button type="button" onclick="sendQuickPrompt('Bahaya ombak rip current dan bendera merah?')" class="text-[11px] font-medium bg-white hover:bg-amber-50 hover:text-amber-700 hover:border-amber-300 border border-slate-200 text-slate-700 px-2.5 py-1.5 rounded-lg shadow-sm transition">
                        🌊 Ombak & Pantai
                    </button>
                </div>
            </div>

            <!-- Dynamic Messages will append here -->

            <!-- Typing indicator (hidden by default) -->
            <div id="typingIndicator" class="hidden flex items-start space-x-2.5">
                <div class="w-8 h-8 rounded-full bg-slate-900 text-amber-400 flex items-center justify-center flex-shrink-0 shadow-sm border border-slate-700">
                    <i class="fa-solid fa-sparkles text-xs animate-spin"></i>
                </div>
                <div class="bg-white border border-slate-200 px-4 py-3 rounded-2xl rounded-tl-none shadow-sm">
                    <div class="flex items-center space-x-1.5">
                        <span class="w-2 h-2 bg-amber-500 rounded-full animate-bounce"></span>
                        <span class="w-2 h-2 bg-amber-500 rounded-full animate-bounce [animation-delay:0.2s]"></span>
                        <span class="w-2 h-2 bg-amber-500 rounded-full animate-bounce [animation-delay:0.4s]"></span>
                        <span class="text-[11px] text-slate-400 ml-1.5 font-medium">Gemini AI memproses singkat...</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Chat Input Form with Max Character Limit & Counter -->
        <div class="p-3 bg-white border-t border-slate-200">
            <form id="chatForm" onsubmit="handleChatSubmit(event)" class="space-y-1.5">
                <div class="flex items-end space-x-2">
                    <div class="flex-1 relative">
                        <textarea 
                            id="chatInput" 
                            rows="1" 
                            maxlength="250"
                            placeholder="Ketik pertanyaan (maks. 250 karakter)..." 
                            class="w-full text-xs sm:text-sm px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:bg-white focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none resize-none max-h-24 transition"
                            oninput="updateCharCounter(this)"
                            onkeydown="if(event.key === 'Enter' && !event.shiftKey) { event.preventDefault(); handleChatSubmit(event); }"
                        ></textarea>
                    </div>
                    <button 
                        type="submit" 
                        id="btnChatSend" 
                        class="p-2.5 sm:px-4 sm:py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold rounded-xl shadow-md hover:shadow-lg active:scale-95 transition flex items-center justify-center flex-shrink-0"
                    >
                        <i class="fa-solid fa-paper-plane text-sm sm:mr-1"></i>
                        <span class="hidden sm:inline text-xs font-bold">Kirim</span>
                    </button>
                </div>
                
                <!-- Live Token & Char Counter Footer -->
                <div class="flex items-center justify-between text-[10px] text-slate-400 px-1">
                    <span id="charCountLabel" class="font-medium text-slate-500">
                        <span id="charCount">0</span>/250 karakter
                    </span>
                    <span class="text-slate-400">
                        <i class="fa-solid fa-shield-heart text-amber-500 mr-1"></i>Output maks. 250 token
                    </span>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    let chatSessionId = localStorage.getItem('baliguard_chat_session') || '';
    if (!chatSessionId) {
        chatSessionId = 'bg_sess_' + Math.random().toString(36).substring(2, 12);
        localStorage.setItem('baliguard_chat_session', chatSessionId);
    }

    function updateCharCounter(textarea) {
        const len = textarea.value.length;
        const countEl = document.getElementById('charCount');
        const labelEl = document.getElementById('charCountLabel');
        if (countEl) countEl.innerText = len;
        
        if (len > 220) {
            labelEl.classList.add('text-amber-600', 'font-bold');
            labelEl.classList.remove('text-slate-500');
        } else {
            labelEl.classList.remove('text-amber-600', 'font-bold');
            labelEl.classList.add('text-slate-500');
        }
    }

    function toggleChatbot(forceState) {
        const drawer = document.getElementById('chatDrawer');
        const trigger = document.getElementById('chatTriggerBtn');
        const isHidden = drawer.classList.contains('hidden');

        if (forceState === true || (forceState === undefined && isHidden)) {
            drawer.classList.remove('hidden');
            drawer.classList.add('flex');
            trigger.classList.add('hidden');
            setTimeout(() => {
                document.getElementById('chatInput').focus();
                scrollChatToBottom();
            }, 100);
        } else {
            drawer.classList.add('hidden');
            drawer.classList.remove('flex');
            trigger.classList.remove('hidden');
        }
    }

    function sendQuickPrompt(promptText) {
        const input = document.getElementById('chatInput');
        input.value = promptText.substring(0, 250);
        updateCharCounter(input);
        handleChatSubmit(new Event('submit'));
    }

    function handleChatSubmit(e) {
        if (e) e.preventDefault();

        const input = document.getElementById('chatInput');
        const text = input.value.trim().substring(0, 250);
        if (!text) return;

        // Append user bubble
        appendUserMessage(text);
        input.value = '';
        input.style.height = 'auto';
        updateCharCounter(input);

        // Show typing indicator
        showTypingIndicator(true);
        scrollChatToBottom();

        // Send to backend Gemini API
        fetch("{{ route('api.chat') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                message: text,
                session_id: chatSessionId
            })
        })
        .then(res => res.json())
        .then(data => {
            showTypingIndicator(false);
            if (data.success && data.reply) {
                appendAssistantMessage(data.reply, data.model, data.is_live_gemini);
            } else {
                appendAssistantMessage("Mohon maaf, sistem AI mengalami kendala sementara. Untuk keadaan darurat langsung, silakan hubungi **112** (Bebas Pulsa) atau **110** (Polisi).");
            }
            scrollChatToBottom();
        })
        .catch(err => {
            showTypingIndicator(false);
            appendAssistantMessage("Koneksi internet terputus. Jika Anda berada dalam situasi darurat, silakan langsung tekan tombol **SOS DARURAT** atau panggil **112**.");
            scrollChatToBottom();
        });
    }

    function appendUserMessage(text) {
        const container = document.getElementById('chatMessages');
        const typing = document.getElementById('typingIndicator');

        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-start justify-end space-x-2';
        wrapper.innerHTML = `
            <div class="flex flex-col items-end max-w-[85%]">
                <div class="bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 font-medium p-3 rounded-2xl rounded-tr-none shadow-sm text-xs sm:text-sm leading-relaxed">
                    ${escapeHtml(text)}
                </div>
                <span class="text-[10px] text-slate-400 mt-1">Anda &bull; ${formatTime(new Date())}</span>
            </div>
        `;
        container.insertBefore(wrapper, typing);
    }

    function appendAssistantMessage(markdownText, modelName, isLive) {
        const container = document.getElementById('chatMessages');
        const typing = document.getElementById('typingIndicator');

        const wrapper = document.createElement('div');
        wrapper.className = 'flex items-start space-x-2.5';
        
        const parsedHtml = renderSimpleMarkdown(markdownText);
        const badge = isLive 
            ? '<span class="text-[10px] text-emerald-600 font-semibold flex items-center mt-1"><i class="fa-solid fa-bolt mr-1"></i> Gemini Live AI (Hemat Token)</span>'
            : '<span class="text-[10px] text-slate-400 mt-1 block">BaliGuard AI &bull; Hemat Token</span>';

        wrapper.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-slate-900 text-amber-400 flex items-center justify-center flex-shrink-0 shadow-sm border border-slate-700 mt-0.5">
                <i class="fa-solid fa-shield-halved text-xs"></i>
            </div>
            <div class="flex-1 max-w-[90%]">
                <div class="bg-white border border-slate-200 p-3.5 rounded-2xl rounded-tl-none shadow-sm text-slate-800 text-xs sm:text-sm leading-relaxed space-y-1.5">
                    ${parsedHtml}
                </div>
                ${badge}
            </div>
        `;
        container.insertBefore(wrapper, typing);
    }

    function showTypingIndicator(show) {
        const indicator = document.getElementById('typingIndicator');
        if (show) {
            indicator.classList.remove('hidden');
        } else {
            indicator.classList.add('hidden');
        }
    }

    function scrollChatToBottom() {
        const container = document.getElementById('chatMessages');
        container.scrollTop = container.scrollHeight;
    }

    function clearChatHistory() {
        if (!confirm('Apakah Anda yakin ingin menghapus percakapan ini?')) return;

        fetch("{{ route('api.chat.clear') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ session_id: chatSessionId })
        }).then(() => {
            const container = document.getElementById('chatMessages');
            container.innerHTML = `
                <div class="flex items-start space-x-2.5">
                    <div class="w-8 h-8 rounded-full bg-slate-900 text-amber-400 flex items-center justify-center flex-shrink-0 shadow-sm border border-slate-700">
                        <i class="fa-solid fa-shield-halved text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <div class="bg-white border border-slate-200 p-3.5 rounded-2xl rounded-tl-none shadow-sm text-slate-800 space-y-2">
                            <p class="font-semibold text-slate-900 text-xs">Percakapan Dibersihkan</p>
                            <p class="leading-relaxed text-xs">
                                Riwayat percakapan telah dihapus. Silakan ajukan pertanyaan baru dengan hemat token.
                            </p>
                        </div>
                    </div>
                </div>
                <div id="typingIndicator" class="hidden flex items-start space-x-2.5"></div>
            `;
        });
    }

    function renderSimpleMarkdown(text) {
        if (!text) return '';
        let escaped = escapeHtml(text);
        
        escaped = escaped.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        escaped = escaped.replace(/\*(.*?)\*/g, '<em>$1</em>');
        escaped = escaped.replace(/_(.*?)_/g, '<em>$1</em>');
        
        escaped = escaped.replace(/\b(112|110|118|119|115|113)\b/g, '<a href="tel:$1" class="text-red-600 font-bold hover:underline bg-red-50 px-1 py-0.5 rounded border border-red-200">$1</a>');

        let lines = escaped.split('\n');
        let html = '';
        let inList = false;

        for (let line of lines) {
            let trimmed = line.trim();
            if (trimmed.startsWith('• ') || trimmed.startsWith('- ') || trimmed.startsWith('* ')) {
                if (!inList) {
                    html += '<ul class="list-disc pl-5 space-y-0.5 my-1">';
                    inList = true;
                }
                html += '<li>' + trimmed.substring(2) + '</li>';
            } else if (/^\d+\.\s/.test(trimmed)) {
                if (!inList) {
                    html += '<ol class="list-decimal pl-5 space-y-0.5 my-1">';
                    inList = true;
                }
                html += '<li>' + trimmed.replace(/^\d+\.\s/, '') + '</li>';
            } else {
                if (inList) {
                    html += '</ul>';
                    inList = false;
                }
                if (trimmed.length > 0) {
                    html += '<p class="my-0.5">' + trimmed + '</p>';
                }
            }
        }
        if (inList) html += '</ul>';

        return html;
    }

    function escapeHtml(string) {
        return String(string).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function formatTime(date) {
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }
</script>
