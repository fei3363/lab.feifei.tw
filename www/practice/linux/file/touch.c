#include <stdio.h>
#include <unistd.h>

int main ()
{
  const char *path = "./fei.txt";
  if (access (path, F_OK) != -1)
    {
      printf ("Flag{good_job_to_touch_file}");
    }
  else
    {
      printf ("No fei.txt in here");
    }
  return 0;
}