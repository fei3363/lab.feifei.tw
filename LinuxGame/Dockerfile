FROM ubuntu:20.04

RUN export DEBIAN_FRONTEND=noninteractive && \
    bash -c 'yes | unminimize' 

RUN apt-get update && apt-get install -y openssh-server
RUN apt-get install -y procps
RUN apt-get install -y sudo
RUN apt-get install -y curl
RUN apt-get install -y man-db

RUN mkdir /var/run/sshd
RUN echo 'root:feifeiP@ssword!' | chpasswd
RUN sed -ri 's/^#PermitEmptyPasswords no/PermitEmptyPasswords yes/' /etc/ssh/sshd_config
RUN sed -ri 's/^#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/^#PasswordAuthentication yes/PasswordAuthentication yes/' /etc/ssh/sshd_config
RUN sed -ri 's/^UsePAM yes/UsePAM no/' /etc/ssh/sshd_config

RUN /etc/init.d/ssh start
RUN groupadd fei
RUN groupadd wendy
# SSH login fix. Otherwise user is kicked off after login
RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd

RUN useradd -rm -d /home/fei -s /bin/bash -g root -G sudo,fei -u 1001 fei -p feifeiP@ssword!
RUN echo 'fei:feifeiP@ssword!' | chpasswd

#RUN echo "flag{cat_lookmetxt}\n勇者好，歡迎光臨 Linux 異世界\n也許當你打開這個文件的時候\n你是失憶的狀態\n你可以看看歷史紀錄\n如果有什麼疑難雜症歡迎問男人 man" > /root/lookme.txt
RUN echo "flag{cat_lookmetxt}\n勇者好，歡迎光臨 Linux 異世界\n也許當你打開這個文件的時候\n你是失憶的狀態\n只知道你在昏迷以前好像看到了一個人影攻擊了你的頭部?讓你昏迷失憶\n你可以看看歷史紀錄\n一步一步回想到底發生了甚麼事情?是誰攻擊了你\n\n如果有什麼疑難雜症歡迎問男人精靈(man)\n" > /home/fei/lookme.txt


#RUN echo "flag{The_bash_history_is_located_under_~/.bash_history}\ncd /tmp\ncat next.txt\n" > /root/.bash_history
RUN echo "flag{The_bash_history_is_located_under_~/.bash_history}\ncd /tmp\ncat next.txt\n" > /home/fei/.bash_history
RUN echo "flag{check_tmp_next.txt}\n你曾經是一個國家的勇者，成功打倒惡龍，國王一高興就把公主許配給了你，並在 2020 年 09 月 18 日舉辦了一場盛大的婚禮，迎娶這個國家最美的公主~\n但是後來發生什麼事情了呢?繼續找尋自己的記憶吧~\n下一個記憶碎片我把它放在一個叫做 treasure.txt 的檔案，想辦法去「find」吧!" > /tmp/next.txt

#RUN useradd -MN FLAGIS_etcpasswd_and_system_log
RUN useradd -rm -d /home/wendy -s /bin/bash -g root -G sudo,wendy  wendy -p wendyP@ssw0rd
RUN echo 'wendy:wendyP@ssw0rd' | chpasswd


RUN echo "flag{good_at_find_file}\n自從你成為國家的駙馬以後，跟公主過著每天幸福快樂的生活，直到有一天你發現公主的日記～\n公主的日記就跟這個記憶碎片放在一起，是一個加密壓縮檔案，但密碼到底是什麼呢?\n(提示：這四個數字對你們兩個來說都是不會忘記，而且每年都要慶祝的呢?會寫在日曆上，可以找找之前的劇情)" > /home/wendy/treasure.txt
COPY wendy.zip /home/wendy/



ENV NOTVISIBLE "in users profile"
RUN echo "export VISIBLE=now" >> /etc/profile

RUN echo 'test "$USER" == "wendy" && echo "flag{Got_Wendy_user}\n恭喜你成功轉換成公主的身分，並且見到公主一面，\n你也跟公主說偷看日記很抱歉，公主也向自己道歉，不該為了怕被發現而攻擊自己，從此公主跟勇者感情更好了!本題 LAB 結束！"' >> /etc/bash.bashrc


RUN chown -R fei:fei /home/fei/
RUN chown -R wendy:wendy /home/wendy/
RUN chmod u+x /home/wendy/.profile

EXPOSE 22
CMD ["/usr/sbin/sshd", "-D"]
