export function timeAgo(dateString) {
    return {
        timeAgoText: "",
        exactTime: dateString,
        isLoading: false,

        startTimer() {
            this.updateTimeAgo();
            setInterval(() => {
                this.updateTimeAgo();
            }, 60000);
        },

        updateTimeAgo() {
            try {
                const months = {
                    Januari: 0,
                    Februari: 1,
                    Maret: 2,
                    April: 3,
                    Mei: 4,
                    Juni: 5,
                    Juli: 6,
                    Agustus: 7,
                    September: 8,
                    Oktober: 9,
                    November: 10,
                    Desember: 11,
                };

                const parts = dateString.split(" ");
                if (parts.length === 3) {
                    const day = parseInt(parts[0]);
                    const month = months[parts[1]];
                    const year = parseInt(parts[2]);

                    const inputDate = new Date(year, month, day);
                    const now = new Date();
                    const diffMs = now - inputDate;
                    const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
                    const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
                    const diffMinutes = Math.floor(diffMs / (1000 * 60));

                    if (diffDays > 0) {
                        this.timeAgoText = `${diffDays} hari lalu`;
                    } else if (diffHours > 0) {
                        this.timeAgoText = `${diffHours} jam lalu`;
                    } else if (diffMinutes > 0) {
                        this.timeAgoText = `${diffMinutes} menit lalu`;
                    } else {
                        this.timeAgoText = "Baru saja";
                    }
                } else {
                    this.timeAgoText = dateString;
                }
            } catch (error) {
                this.timeAgoText = dateString;
            }
        },
    };
}
