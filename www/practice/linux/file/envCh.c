#include <stdio.h>
#include <string.h>

int main(int argc, char *argv[], char * envp[])
{
    int i;
    
    // You have to set varname is Cat and varvalue is Good to get Flag.
    for (i = 0; envp[i] != NULL; i++)
    {    
        if (!strcmp(envp[i],"Cat=Good")){
            printf("恭喜你成功設定環境變數\n");
            printf("Flag{you_learned_export}\n");
            return(0);
        }
        
    }
    printf("你必須設定環境變數名稱 Cat 該值為 Good 才能拿到 Flag \n");
}