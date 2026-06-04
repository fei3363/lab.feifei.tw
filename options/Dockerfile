FROM python:3.7.2-stretch

COPY ./options/ /app

WORKDIR /app

RUN ls -al && pwd 

RUN pip3 install -r requirements.txt

EXPOSE 5000 

CMD python3 main.py