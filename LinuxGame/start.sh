
docker stop $(docker ps -a -q --filter ancestor=linuxgame)
docker rm -f $(docker ps -a -q --filter ancestor=linuxgame)
docker build -t linuxgame .
# for i in {49999..50000}
# do
#     docker run -d -p $i:22  linuxgame
# done

for i in {49999..50050}
do
    docker run -d -p $i:22  linuxgame
done

