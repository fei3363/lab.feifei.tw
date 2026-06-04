#include <stdio.h>
#include <string.h>

int main(int argc, char *argv[], char * envp[])
{
    int i;
 
    for (i = 0; envp[i] != NULL; i++)
    {    
        if (!strcmp(envp[i],"Cat=Good")){
            printf("Flag{you_learned_export}");
            return(0);
        }
        
    }
    printf("\nplease set an environment variable with the name  cat and the value Good to get the flag");
    
}