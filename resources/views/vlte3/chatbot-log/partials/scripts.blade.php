<style>
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<script>
    let currentLogId = null;
    let deleteLogId = null;

        // Show detail modal
        function showDetail(id) {
            currentLogId = id;
            
            // Show loading
            $('#detailModal').modal('show');
            
            // Fetch data
            $.ajax({
                url: `/admin/chatbot-log/${id}`,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        const log = response.data;
                        
                        $('#detail-question').text(log.question);
                        $('#detail-answer').text(log.answer || 'Tidak ada jawaban');
                        $('#detail-device').text(log.device || 'Unknown');
                        $('#detail-browser').text(log.browser || 'Unknown');
                        $('#detail-os').text(log.os_platform || 'Unknown');
                        $('#detail-user-agent').text(log.user_agent || 'Unknown');
                        
                        // Format date
                        const date = new Date(log.created_at);
                        const options = { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' };
                        $('#detail-date').text(date.toLocaleDateString('id-ID', options));
                        
                        // Knowledge status
                        if (log.knowledge_status === 'found') {
                            let statusText = '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Ada di Knowledge Base</span>';
                            if (log.matched_knowledge) {
                                statusText += '<br><small class="text-muted mt-1">Cocok dengan: <strong>' + log.matched_knowledge + '</strong></small>';
                            }
                            $('#detail-knowledge-status').html(statusText);
                        } else if (log.knowledge_status === 'not_found') {
                            $('#detail-knowledge-status').html('<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Tidak Ada di Knowledge Base</span>');
                        } else {
                            $('#detail-knowledge-status').html('<span class="badge badge-warning"><i class="fas fa-clock"></i> Pending</span>');
                        }
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data'
                    });
                    $('#detailModal').modal('hide');
                }
            });
        }

        // Confirm delete
        function confirmDelete(id, question) {
            deleteLogId = id;
            $('#delete-question-text').text(question);
            $('#deleteModal').modal('show');
        }

        // Delete log
        function deleteLog() {
            if (!deleteLogId) return;
            
            $.ajax({
                url: `/admin/chatbot-log/${deleteLogId}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(response) {
                    if (response.success) {
                        $('#deleteModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal menghapus log'
                    });
                }
            });
        }

        // Confirm clear all
        function confirmClearAll() {
            $('#clearAllModal').modal('show');
        }

        // Clear all logs
        function clearAllLogs() {
            $.ajax({
                url: '/admin/chatbot-log/clear-all',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#clearAllModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal menghapus semua log'
                    });
                }
            });
        }
</script>
