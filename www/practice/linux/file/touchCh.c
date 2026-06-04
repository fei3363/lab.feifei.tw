#include <stdio.h>
#include <unistd.h>

int main ()
{
  const char *path = "./fei.txt";
  if (access (path, F_OK) != -1)
    {
      printf ("恭喜你成功在目前的資料夾新增 fei.txt\n");
      printf ("Flag{good_job_to_touch_file}\n");
    }
  else
    {
      printf ("這個資料夾裡面沒有 fei.txt ，請嘗試新增 fei.txt 在目前的資料夾內");
    }
  return 0;
}