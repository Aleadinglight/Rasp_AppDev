#include "screen.h"
#include <stdio.h>

// function definitions
void clearScreen(void){
        printf("\033[2J");
        fflush(stdout);
}

void setFGcolor(int fg){        // fg is a value between 30
        printf("\033[%d;1m", fg);
        fflush(stdout); // send out the esc sequence
}

void resetColors(void){
        printf("\033[0m");
        fflush(stdout);
}

void gotoXY(int row, int col){
        // row number should be 1-30, col should be 1-80
        printf("\033[%d;%dH", row, col);
        fflush(stdout);
}

void displayBar(int col, double rms){
        int i;
        for(i=0; i<rms/20; i++){
        	gotoXY(i+1, col);
#ifdef UNICODE
			printf("%s", BAR);
#else
			printf("*");
#endif
        }
        fflush(stdout);
}
